<?php

namespace backend\controllers;

use Yii;
use common\models\Download;
use backend\models\DownloadSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\components\MainController;
use backend\components\AccessRule;

/**
 * DownloadController implements the CRUD actions for Download model.
 */
class DownloadController extends MainController
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
     * Lists all Download models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DownloadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
		$model = Download::find()->limit(10)->orderBy(['hits' => SORT_DESC])->all();
		
		foreach($model as $key =>  $val){
			array_push($dataX,$val['judul']);
			array_push($dataY,(int)$val['hits']);
			
		}
		
		return $this->render('grafik', [
			'dataX'=>$dataX,
			'dataY'=>$dataY,
		]);    
    }

    /**
     * Displays a single Download model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Download model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Download();
        $model->scenario = "create";

        if ($model->load(Yii::$app->request->post()) && $model->simpan()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Download model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = "update";

        if ($model->load(Yii::$app->request->post()) && $model->simpan()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Download model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $file_path = $model->getPath().$model->nama_file;

        $model->delete();
        $model->deleteFile($file_path);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Download model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Download the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if(Yii::$app->user->identity->level=='admin')
            $model = Download::findOne($id);
        else
            $model = Download::find()
                        ->where(['username'=>Yii::$app->user->identity->username,'id_download'=>$id])
                        ->one();

        if ($model !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
