<?php

namespace backend\controllers;

use Yii;
use common\models\KataSensor;
use backend\models\KataSensorSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\components\MainController;
use backend\components\AccessRule;



/**
 * KataSensorController implements the CRUD actions for KataSensor model.
 */
class KataSensorController extends MainController
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
     * Lists all KataSensor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KataSensorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new KataSensor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new KataSensor();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing KataSensor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing KataSensor model.
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
     * Finds the KataSensor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KataSensor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KataSensor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionEdit()
    {
        $path ='../'.Yii::$app->params['uploadUrlOther'];
        $path = str_replace("/","\\", $path);
        $my_file = $path.'badword.txt';

        if(Yii::$app->request->post())
        {
            $katabaru = Yii::$app->request->post("kata");
            $katabaru = str_replace(";", ",", $katabaru);
            chmod($my_file, 0644);
            $filee = fopen($my_file, "w");
            fwrite($filee, $katabaru);
            fclose($filee);
            return $this->redirect(['edit']);

        }
        
        $data = "";

        if(file_exists($my_file)){
            if(filesize($my_file) > 0){
                $handle = fopen($my_file, 'r');
                $data = fread($handle,filesize($my_file));
                fclose($handle);
            }
        }

        return $this->render('edit', [
            'model' => $data,
        ]);
    }
}
