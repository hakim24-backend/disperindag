<?php

namespace backend\controllers;

use Yii;
use common\models\PelayananInstansi;
use common\models\PelayananInstansiLayanan;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\components\MainController;
use backend\components\AccessRule;

/**
 * PelayananInstansiController implements the CRUD actions for PelayananInstansi model.
 */
class PelayananInstansiController extends MainController
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
                    'delete-jenis-pelayanan' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all PelayananInstansi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => PelayananInstansi::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PelayananInstansi model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => PelayananInstansiLayanan::find()->where(['id_pelayanan_instansi'=>$id]),
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new PelayananInstansi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PelayananInstansi();

        if ($model->load(Yii::$app->request->post()) && $model->simpan()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PelayananInstansi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->simpan()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PelayananInstansi model.
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
     * Finds the PelayananInstansi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PelayananInstansi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PelayananInstansi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**------------ JENIS PELAYANAN -------------**/

    /**
     * Creates a new PelayananInstansiLayanan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateJenisPelayanan($id_instansi)
    {
        $model = new PelayananInstansiLayanan();
        $model->id_pelayanan_instansi = $id_instansi;
        if ($model->load(Yii::$app->request->post()) && $model->simpan()) {
            return $this->redirect(['view-jenis-pelayanan', 'id' => $model->id]);
        } else {
            return $this->render('pelayanan-instansi-layanan/create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays a single PelayananInstansiLayanan model.
     * @param integer $id
     * @return mixed
     */
    public function actionViewJenisPelayanan($id)
    {
        return $this->render('pelayanan-instansi-layanan/view', [
            'model' => $this->findModelJenisPelayanan($id),
        ]);
    }

    /**
     * Updates an existing PelayananInstansiLayanan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdateJenisPelayanan($id)
    {
        $model = $this->findModelJenisPelayanan($id);

        if ($model->load(Yii::$app->request->post()) && $model->simpan()) {
            return $this->redirect(['view-jenis-pelayanan', 'id' => $model->id]);
        } else {
            return $this->render('pelayanan-instansi-layanan/update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PelayananInstansiLayanan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteJenisPelayanan($id)
    {
        $model = $this->findModelJenisPelayanan($id);
        $instansi_id = $model->id_pelayanan_instansi;
        
        $model->delete();

        return $this->redirect(['view','id'=>$instansi_id]);
    }

    /**
     * Finds the PelayananInstansiLayanan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PelayananInstansiLayanan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelJenisPelayanan($id)
    {
        if (($model = PelayananInstansiLayanan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
