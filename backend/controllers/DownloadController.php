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
		$model = Yii::$app->db->createCommand('SELECT DISTINCT YEAR(tanggal) as tahun from hubungi ORDER BY tahun ASC')->queryAll();
		foreach($model as $key =>  $val){
			$tampX = array();
			$tampX = Yii::$app->db->createCommand('SELECT  MONTH(tanggal) as bln, count(*) as jml from hubungi where YEAR(tanggal) = '.$val['tahun'].' GROUP BY MONTH(tanggal)')->queryAll();
			foreach($tampX as $keyX =>  $valX){
				//set data X
				array_push($dataX,$this->setBulan($valX['bln'],$val['tahun']));
				
				//set data Y
				array_push($dataY,(int)$valX['jml']);
				
			}	
		}
		
        if (Yii::$app->request->post('kvdate3')){
			$dataX = array();
			$dataY = array();
			$dateRange = Yii::$app->request->post('kvdate3');
			$time1 = strtotime(explode(' - ',$dateRange)[0]);
			$time2 = strtotime(explode(' - ',$dateRange)[1]);
			$dateStart =  date('Y-m-d',$time1);
			$dateEnd =  date('Y-m-d',$time2);
			
			
			
			$modelFilter = Yii::$app->db->createCommand('SELECT DISTINCT YEAR(tanggal) as tahun from hubungi WHERE tanggal BETWEEN "'.$dateStart.'" AND "'.$dateEnd.'" ORDER BY tahun ASC')->queryAll();
			
			foreach($modelFilter as $key =>  $val){
				$tampX = array();
				
				$tampX = Yii::$app->db->createCommand('SELECT  MONTH(tanggal) as bln, count(*) as jml from hubungi where YEAR(tanggal) = '.$val['tahun'].' GROUP BY MONTH(tanggal)')->queryAll();
				
				foreach($tampX as $keyX =>  $valX){
					//set data X
					array_push($dataX,$this->setBulan($valX['bln'],$val['tahun']));
					
					//set data Y
					array_push($dataY,(int)$valX['jml']);
					
				}
				
					
			}
			
			//var_dump($dataX);die();
			
			return $this->render('grafik', [
				'dataX'=>$dataX,
				'dataY'=>$dataY,
			]);
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
