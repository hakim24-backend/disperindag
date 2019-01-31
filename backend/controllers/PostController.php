<?php

namespace backend\controllers;

use Yii;
use common\models\Post;
use backend\models\PostSearch;
use backend\models\PollsResult;
use backend\models\MemberMobile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\BroadcastBerita;
use yii\filters\AccessControl;
use backend\components\MainController;
use backend\components\AccessRule;
use backend\firebase\Firebase;
use backend\firebase\Push;
/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends MainController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class'=> AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules'=> [
                    [
                        'allow'=>true,
                        'roles'=>['@'],
                    ],
                    [
                        'actions' => ['broadcast-to-firebase'],
                        'allow' => true,
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'headline' => ['post'],
                    'broadcast-notif' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
    public function actionChart()
    {
        $pollSangatBagus = PollsResult::find()->where(['id_answer'=>54])->count();
        $pollBagus = PollsResult::find()->where(['id_answer'=>55])->count();
        $pollBiasaSaja = PollsResult::find()->where(['id_answer'=>56])->count();
        $pollKurangBagus = PollsResult::find()->where(['id_answer'=>57])->count();


        return $this->render('chart', [
            'pollSangatBagus' => $pollSangatBagus,
            'pollBagus' => $pollBagus,
            'pollBiasaSaja' => $pollBiasaSaja,
            'pollKurangBagus' => $pollKurangBagus

        ]);
    }

	/**
     * Displays a single Contact model.
     * @param integer $id
     * @return mixed
     */
    public function actionGrafik()
    {
		
		$dataX = array();
		$dataY = array();
		$model = Post::find()->select(['judul','dibaca'])->limit(10)->orderBy(['dibaca' => SORT_DESC])->all();
		
		foreach($model as $key =>  $val){
			//array_push($dataY, $val['judul']);
			array_push($dataX,$val['judul']);
			array_push($dataY,(int)$val['dibaca']);
			
			//$dataX[] = array('type'=> 'bar', 'name' =>$val['judul'], 'data' => array((int)$val['dibaca']));
		}
		//var_dump($data);die();
		return $this->render('grafik', [
			'dataX'=>$dataX,
			'dataY'=>$dataY,
		]);    
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $haveBroadcast = BroadcastBerita::find()->where(['id_berita'=>$id,'date'=>date("Y-m-d")])->count();
        $pollSangatBagus = PollsResult::find()->where(['id_berita'=>$id,'id_answer'=>54])->count();
        $pollBagus = PollsResult::find()->where(['id_berita'=>$id,'id_answer'=>55])->count();
        $pollBiasaSaja = PollsResult::find()->where(['id_berita'=>$id,'id_answer'=>56])->count();
        $pollKurangBagus = PollsResult::find()->where(['id_berita'=>$id,'id_answer'=>57])->count();

        if($haveBroadcast > 0)
            $model->status_broadcast = 1;
        else
            $model->status_broadcast = 0;
        $model->save();

        return $this->render('view', [
            'model' => $model,
            'pollSangatBagus' => (int)$pollSangatBagus,
            'pollBagus' => (int)$pollBagus,
            'pollBiasaSaja' => (int)$pollBiasaSaja,
            'pollKurangBagus' => (int)$pollKurangBagus,

        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();
        $model->scenario = 'create';
        $model->headline = 'N';

        if ($model->load(Yii::$app->request->post()) && $model->simpan()) {
            return $this->redirect(['view', 'id' => $model->id_berita]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';

        $tag_checked = explode(",", $model->tag);
        $model->tag = $tag_checked;        

        if ($model->load(Yii::$app->request->post()) && $model->simpan()) {
            return $this->redirect(['view', 'id' => $model->id_berita]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Make berita become headline
     * @param integer $id
     * @return mixed
     */
    public function actionHeadline($id)
    {
        $model = $this->findModel($id);
        if($model->headline == 'Y'){
            $model->headline = 'N';
        }else if($model->headline == 'N'){
            $model->headline = 'Y';
        }

        $model->save();
        return $this->redirect(['view', 'id' => $id]);
    }

    // 
    public function actionBroadcastToFirebase($id){
        $model =  Post::findOne($id);
        $device_tokens = MemberMobile::find()->select(['broadcast_token'])->where(['not', ['broadcast_token' => null]])->all();
        // var_dump($device_tokens);die;
        if($device_tokens){
            $push = null;
            $url_bash = "http://disperindag.jatimprov.go.id";
            $image = $url_bash.Yii::$app->params['uploadUrlPost']."thumb_mobile/small_".$model->gambar;
            if(!$this->is_url_exist($image)){
                $image = $url_bash.Yii::$app->params['uploadUrlPost']."default-mobile.png";
            }
            $push = new Push();
            $push->News($model->id_berita, $model->judul, $model->getStringThumb($model->isi_berita,100), $image);
            $mPushNotification = $push->getPush();
            // var_dump($mPushNotification);
            foreach ($device_tokens as $key => $value) {
                // var_dump($value->broadcast_token);
                // echo "<br>";
                // echo "<br>";
                $firebase = new Firebase();
                $firebase->send($value->broadcast_token, $mPushNotification);
            }
    
            $broadcast_model = new BroadcastBerita();
            $broadcast_model->date = date("Y-m-d", time());
            $broadcast_model->id_berita = $id;
            $broadcast_model->save();
            
            $return = [
                'event'=>'berita',
                'id'=>$model->id_berita,
                'judul'=>$model->judul,
                'message'=>$model->getStringThumb($model->isi_berita,100),
                'gambar_url'=>$image,
            ];
            
            return json_encode($return,JSON_FORCE_OBJECT);
        }else{
            $response['error']=true;
            $response['message']='Parameters missing';
        }
    }

    /**
     * Broadcast berita, notif to mobile apps
     * @param integer $id
     * @return mixed
     */
    public function actionBroadcastNotif($id)
    {
        $model = $this->findModel($id);
        $broadcast_model = new BroadcastBerita();
        $broadcast_model->date = date("Y-m-d",time());
        $broadcast_model->id_berita = $id;
        $broadcast_model->save();

        $url_bash = "http://disperindag.jatimprov.go.id";
        $image = $url_bash.Yii::$app->params['uploadUrlPost']."thumb_mobile/small_".$model->gambar;
        if(!$this->is_url_exist($image)){
            $image = $url_bash.Yii::$app->params['uploadUrlPost']."default-mobile.png";
        }
        
        $return = [
            'event'=>'berita',
            'id'=>$model->id_berita,
            'judul'=>$model->judul,
            'deskripsi'=>$model->getStringThumb($model->isi_berita,100),
            'gambar_url'=>$image,
        ];
        
        return json_encode($return,JSON_FORCE_OBJECT);
        //return $this->redirect(['view', 'id' => $id]);
    }   

    public function is_url_exist($url){
        $ch = curl_init($url);    
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if($code == 200){
           $status = true;
        }else{
          $status = false;
        }
        curl_close($ch);
       return $status;
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if(Yii::$app->user->identity->level=='admin')
            $model = Post::findOne($id);
        else
            $model = Post::find()->where(['username'=>Yii::$app->user->identity->username,'id_berita'=>$id])->one();

        if ($model !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
