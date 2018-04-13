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
}
