<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use backend\components\MainController;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use common\models\Visitors;
use common\models\Contact;
use common\models\Post;
use common\models\Agenda;
use common\models\Download;
use backend\models\MemberMobile;

/**
 * Site controller
 */
class SiteController extends MainController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'visit-stats', 'visit-stats-month', 'visit-stats-year'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

   

    public function actionIndex()
    {
        $rows = (new \yii\db\Query())
            ->select(array('save_name', 'save_value'))
            ->from('pcounter_save')
            ->all();
        $data = array();
        foreach ($rows as $row) {
            $data[ $row['save_name'] ] = $row['save_value'];
        }
        $rows = (new \yii\db\Query())
            ->select(['count(user_ip) AS user_today','sum(visits) AS hits_today'])
            ->from('pcounter_users')
            ->one();
        $count['pengunjung'] = $data['counter'] + $rows['user_today'];
        $count['kunjungan'] = $data['hits'] + $rows['hits_today'];
        $count['post'] = Post::find()->count();
        $count['member'] = MemberMobile::find()->where(['status'=>10])->count();
        $count['member_baru'] = MemberMobile::find()->where(['seen'=>0])->count();
        

        $list['post'] = Post::find()
                        ->orderBy(['id_berita'=>SORT_DESC])
                        ->limit(7);
        $list['agenda'] = Agenda::find()
                        ->where("tgl_mulai > '".date("Y-m-d")."'")
                        ->orderBy(['tgl_mulai'=>SORT_DESC])
                        ->limit(10);
        $list['download'] = Download::find()
                        ->orderBy(['hits'=>SORT_DESC])
                        ->limit(10);

        if(Yii::$app->user->identity->level=='admin'){
            $list['bukutamu'] = Contact::find()
                                ->orderBy(['seen'=>SORT_ASC,'id_hubungi'=>SORT_DESC])
                                ->limit(5)
                                ->all();
            $list['member'] = MemberMobile::find()
                            ->orderBy(['seen'=>SORT_ASC,'id'=>SORT_DESC])
                            ->limit(10)
                            ->all();
        }else{
            $list['post'] = $list['post']->where(['username'=>Yii::$app->user->identity->username]);    
            $list['agenda'] = $list['agenda']->andWhere(['username'=>Yii::$app->user->identity->username]);    
            $list['download'] = $list['download']->where(['username'=>Yii::$app->user->identity->username]);    
        }
        
        $list['post'] = $list['post']->all();
        $list['agenda'] = $list['agenda']->all();
        $list['download'] = $list['download']->all();

        return $this->render('index',[
            'list' => $list,
            'count' => $count,
        ]);
    }

    public function actionVisitStatsYear()
    {
        $response = array();
        $dates = array();
        $visitors_model_dates = Visitors::find()
                            ->select(["date", "COUNT(*) as user_identifier","SUM(visits) as visits"])
                            ->groupBy("YEAR(date)")
                            ->all();
        
        $response["dates"] = array();
        $response["visitors"] = array();
        $response["visits"] = array();
        foreach ($visitors_model_dates as $model){
            $datetime = strtotime($model->date);
            array_push($response["dates"], date("Y",$datetime));
            array_push($response["visitors"], $model->user_identifier);
            array_push($response["visits"], $model->visits);
        }
        echo json_encode($response);
    }

    public function actionVisitStatsMonth($year)
    {
        $start = $year.'-1-01';
        $end = $year.'-12-31';
        $response = array();
        $dates = array();
        $visitors_model_dates = Visitors::find()
                            ->select(["date", "COUNT(*) as user_identifier","SUM(visits) as visits"])
                            ->where("date between '".$start."' and '".$end."'")
                            ->groupBy("YEAR(date), MONTH(date)")
                            ->all();
        
        $response["dates"] = array();
        $response["visitors"] = array();
        $response["visits"] = array();
        foreach ($visitors_model_dates as $model){
            $datetime = strtotime($model->date);
            array_push($response["dates"], date("M Y",$datetime));
            array_push($response["visitors"], $model->user_identifier);
            array_push($response["visits"], $model->visits);
        }
        echo json_encode($response);
    }

    public function actionVisitStats($start,$end)
    {
		$this->layout="";
        $response = array();
        $dates = array();
        $visitors_model_dates = Visitors::find()
                            ->select(["date", "COUNT(*) as user_identifier","SUM(visits) as visits"])
                            ->where("date between '".$start."' and '".$end."'")
                            ->groupBy("date")
                            ->distinct()
                            ->all();
        $response["dates"] = array();
        $response["visitors"] = array();
        $response["visits"] = array();
        foreach ($visitors_model_dates as $model){
            $datetime = strtotime($model->date);
            array_push($response["dates"], date("M jS",$datetime));
            array_push($response["visitors"], $model->user_identifier);
            array_push($response["visits"], $model->visits);
        }
        echo json_encode($response);
    }

    public function actionLogin()
    {
        $this->layout = "portal";
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
