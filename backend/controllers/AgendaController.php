<?php

namespace backend\controllers;

use Yii;
use common\models\Agenda;
use backend\models\AgendaSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\BroadcastAgenda;
use yii\filters\AccessControl;
use backend\components\MainController;
use backend\components\AccessRule;
use backend\firebase\Firebase;
use backend\firebase\Push;
use backend\models\MemberMobile;
/**
 * AgendaController implements the CRUD actions for Agenda model.
 */
class AgendaController extends MainController
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
                ],
            ],
        ];
    }

    /**
     * Lists all Agenda models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AgendaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Agenda model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if(Yii::$app->user->identity->level=="admin" && $model->seen!=1){
            $model->seen = 1;
            $model->save();
        }

        $haveBroadcast = BroadcastAgenda::find()->where(['id_agenda'=>$id,'date'=>date("Y-m-d")])->count();
        if($haveBroadcast > 0)
            $model->status_broadcast = 1;
        else
            $model->status_broadcast = 0;
        $model->save();

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Agenda model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Agenda();

        if ($model->load(Yii::$app->request->post()) && $model->simpan()) {
            return $this->redirect(['view', 'id' => $model->id_agenda]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Agenda model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if($model->seen == 1)
            $model->seen = 2;
        if ($model->load(Yii::$app->request->post()) && $model->simpan()) {
            return $this->redirect(['view', 'id' => $model->id_agenda]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Agenda model.
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
     * Broadcast Agenda, notif to mobile apps
     * @param integer $id
     * @return mixed
     */
    public function actionBroadcastNotif($id)
    {
        $model = $this->findModel($id);
        $broadcast_model = new BroadcastAgenda();
        $broadcast_model->date = date("Y-m-d",time());
        $broadcast_model->id_agenda = $id;
        $broadcast_model->save();

        $return = [
            'id'=>$model->id_agenda,
            'topik'=>$model->tema,
            'tanggal_mulai'=> $model->tgl_mulai,
            'tanggal_selesai'=> $model->tgl_selesai,
            'lokasi'=> $model->tempat,
            'jam'=> $model->jam,
        ];
        return json_encode($return,JSON_FORCE_OBJECT);
    }

    public function actionBroadcastToFirebase($id)
    {
        $model = Agenda::findOne($id);
        $device_tokens = MemberMobile::find()->select(['broadcast_token'])->where(['not', ['broadcast_token' => null]])->all();

        if ($device_tokens) {
            $push = null;
            $push = new Push();
            $push->Agenda($model->id_agenda, $model->tema, $model->tgl_mulai, $model->tgl_selesai,$model->jam,$model->tempat);
            $mPushNotification = $push->getPushAgenda();
            foreach ($device_tokens as $key => $value) {
                $firebase = new Firebase();
                $firebase->send($value->broadcast_token, $mPushNotification);
            }
    
            $broadcast_model = new BroadcastAgenda();
            $broadcast_model->date = date("Y-m-d",time());
            $broadcast_model->id_agenda = $id;
            $broadcast_model->save();

            $return = [
                'id'=>$model->id_agenda,
                'topik'=>$model->tema,
                'tanggal_mulai'=> $model->tgl_mulai,
                'tanggal_selesai'=> $model->tgl_selesai,
                'lokasi'=> $model->tempat,
                'jam'=> $model->jam,
            ];
            return json_encode($return,JSON_FORCE_OBJECT);      
        }else{
            $response['error']=true;
            $response['message']='Parameters missing';
        }
        
    }

    /**
     * Finds the Agenda model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Agenda the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {   
        if(Yii::$app->user->identity->level=='admin')
            $model = Agenda::findOne($id);
        else
            $model = Agenda::find()
                        ->where(['username'=>Yii::$app->user->identity->username,'id_agenda'=>$id])
                        ->one();

        if ($model !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
