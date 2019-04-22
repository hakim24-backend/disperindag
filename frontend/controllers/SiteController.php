<?php
namespace frontend\controllers;

use Yii;
use frontend\components\MainHomeController;
use common\models\LoginForm;
use common\models\Post;
use common\models\Download;
use common\models\Agenda;
use common\models\Video;
use common\models\RunningText;
use common\models\LinkTerkait;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends MainHomeController
{
    
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "home";
        
        
        $model_video = Video::find()
                        ->orderBy(['id_video'=>SORT_DESC])
                        ->one();

        $sidebar['download'] = Download::find()
                                  ->select(['judul','nama_file'])
                                  ->orderBy(['hits'=>SORT_ASC])
                                  ->limit(9)
                                  ->all();
        $sidebar['agenda'] = Agenda::find()
                                      ->select(['tema','tema_seo','tgl_mulai'])
                                      ->orderBy(['id_agenda'=>SORT_DESC])
                                      ->limit(4)
                                      ->all();

        $running_text = RunningText::find()
                        ->select(['info'])
                        ->all();

        $model_banner = Post::find()
                            ->select(['id_berita','judul','judul_seo','isi_berita','gambar'])
                            ->where(['headline'=>'Y'])
                            ->orderBy(['id_berita'=>SORT_DESC])
                            ->limit(5)
                            ->all();

        $id_berita = Array();
        foreach ($model_banner as $key => $value) {
            $id_berita[] = $value->id_berita;
        }
        
        $list_post = Post::find()
                            ->orderBy(['id_berita'=>SORT_DESC])
                            ->where(['not in','id_berita',$id_berita])
                            ->limit(9)
                            ->all();
        
        foreach ($list_post as $key => $value) {
            $id_berita[] = $value->id_berita;
        }
		
    		$timepopu = date('Y-m-01',strtotime( '-4 month', time()));
            $popunews = Post::find()
    					  ->select(['judul','judul_seo','hari','jam','tanggal','gambar'])
    					  ->where(['not in','id_berita',$id_berita])
    					  ->andWhere(['>=','tanggal',$timepopu])
    					  ->orderBy(['dibaca'=>SORT_DESC])
    					  ->limit(6);
    		
    		if($popunews->count() >= 6){
    			$sidebar['popular_post'] = $popunews->all();
    		}else{
    			$timepopu = date('Y-m-01',strtotime( '-12 month', time()));
    			$sidebar['popular_post'] = Post::find()
    					  ->select(['judul','judul_seo','hari','jam','tanggal','gambar'])
    					  ->where(['not in','id_berita',$id_berita])
    					  ->andWhere(['>=','tanggal',$timepopu])
    					  ->orderBy(['dibaca'=>SORT_DESC])
    					  ->limit(4)
    					  ->all();
    		}

    $list_link_terkait = LinkTerkait::find()->all();


        return $this->render('index',[
            'list_post'     => $list_post,
            'model_video'   => $model_video,
            'model_banner'  => $model_banner,
            'sidebar'       => $sidebar,
            'running_text'  => $running_text,
            'list_link_terkait' => $list_link_terkait
        ]);
    }

    public function actionPasar()
    {
      $dataPasar = file_get_contents('http://siskaperbapo.com/api/?username=pihpsapi&password=xxhargapanganxx&task=getMasterMarket');
      $dataArrayPasar = json_decode($dataPasar,true);

      $dataComodity = file_get_contents('http://siskaperbapo.com/api/?username=pihpsapi&password=xxhargapanganxx&task=getDailyPriceAllMarket&tanggal='.date('Y-m-d'));
      $dataArrayComodity = json_decode($dataComodity,true);
      var_dump($dataArray['result']);
    }
   
}
