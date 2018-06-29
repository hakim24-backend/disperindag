<?php

namespace backend\controllers;

use Yii;
use common\models\Contact;
use common\models\ContactBalas;
use backend\models\PrintBukuTamuForm;
use backend\models\ContactSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\components\MainController;
use backend\components\AccessRule;

/**
 * BukuTamuController implements the CRUD actions for Contact model.
 */
class BukuTamuController extends MainController
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
                        'roles'=>['admin'],
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
     * Lists all Contact models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContactSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $printForm = new PrintBukuTamuForm();
        if ($printForm->load(Yii::$app->request->post()) && $printForm->check()){
            $dataPrint = $printForm->getDataPrint();
            $this->layout = "print";
            return $this->render('print_page', [
                'dataPrint' => $dataPrint,
            ]);
        }else{
            return $this->render('index', [
                'printForm' => $printForm,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
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
     * Displays a single Contact model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->seen();

        $balasan = ContactBalas::find()
                        ->where(['id_hubungi'=>$id])
                        ->orderBy(['id'=>SORT_DESC])
                        ->all();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) 
            return $this->redirect(['view', 'id' => $model->id_hubungi]);
        
        return $this->render('view', [
            'model' => $model,
            'balasan' => $balasan,
        ]);
    }

    /**
     * Creates a new Contact model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contact();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_hubungi]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Contact model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->seen();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_hubungi]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Contact model.
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
     * Finds the Contact model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contact the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contact::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionComposeEmail($id)
    {
        $model = new ContactBalas();
        $model->id_hubungi = $id;
        $model->email = $model->bukuTamu->email;
        $model->subjek = $model->bukuTamu->subjek;
        $model->pesan = "
            <p>Terima kasih telah menghubungi kami, mengenai pertanyaan Saudara seperti tercantum dibawah ini :</p>
            <p>".$model->bukuTamu->pesan."</p>
            <p>&nbsp;</p>
            <p>Jawab:</p>
            <p>...</p>";

        if ($model->load(Yii::$app->request->post()) && $model->compose()) {
            return $this->redirect(['view', 'id' => $model->id_hubungi]);
        } else {
            return $this->render('compose',[
                'model' => $model,
            ]);
        }
    }
	
	protected function setBulan($bln,$tahun)
    {
        if($bln == 1){
			return 'Januari '.$tahun;
		}else if($bln == 2){
			return 'Februari '.$tahun;
		}else if($bln == 3){
			return 'Maret '.$tahun;
		}else if($bln == 4){
			return 'April '.$tahun;
		}else if($bln == 5){
			return 'Mei '.$tahun;
		}else if($bln == 6){
			return 'Juni '.$tahun;
		}else if($bln == 7){
			return 'Juli '.$tahun;
		}else if($bln == 8){
			return 'Agustus '.$tahun;
		}else if($bln == 9){
			return 'September '.$tahun;
		}else if($bln == 10){
			return 'Oktober '.$tahun;
		}else if($bln == 11){
			return 'November '.$tahun;
		}else if($bln == 12){
			return 'Desember '.$tahun;
		}else{
			return 'Nan '.$tahun;
		}
    }
}
