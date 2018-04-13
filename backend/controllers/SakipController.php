<?php

namespace backend\controllers;

use Yii;
use common\models\Sakip;
use common\models\SakipKategori;
use common\models\SakipKategoriFile;
use common\models\SakipKategoriFileSearch;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\components\MainController;
use backend\components\AccessRule;

class SakipController extends MainController
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
     * Lists all SakipKategori models.
     * @return mixed
     */
    public function actionIndex()
    {
    	$model = Sakip::find()->one();
    	$dataProvider = new ActiveDataProvider([
            'query' => SakipKategori::find(),
        ]);

        return $this->render('index',[
        	'model' => $model,
        	'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing SakipKategori model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $model = Sakip::find()->one();

        if ($model->load(Yii::$app->request->post()) && $model->simpan()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    /**---------------- Kategori Laporan SAKIP -----------------**/


    /**
     * Displays a single SakipKategori model.
     * @param integer $id
     * @return mixed
     */
    public function actionViewKategori($id)
    {
    	$searchModel = new SakipKategoriFileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);

        return $this->render('sakip-kategori/view', [
            'model' => $this->findModelKategori($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new SakipKategori model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateKategori()
    {
        $model = new SakipKategori();

        if ($model->load(Yii::$app->request->post()) && $model->simpan()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('sakip-kategori/create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SakipKategori model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdateKategori($id)
    {
        $model = $this->findModelKategori($id);

        if ($model->load(Yii::$app->request->post()) && $model->simpan()) {
            return $this->redirect(['view-kategori', 'id' => $model->id]);
        } else {
            return $this->render('sakip-kategori/update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SakipKategori model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteKategori($id)
    {
        $this->findModelKategori($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SakipKategori model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SakipKategori the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelKategori($id)
    {
        if (($model = SakipKategori::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    /*** -------------------- FILE LAPORAN ----------------------- ***/


    /**
     * Displays a single SakipKategoriFile model.
     * @param integer $id
     * @return mixed
     */
    public function actionViewFileLaporan($id)
    {
        return $this->render('sakip-file-laporan/view', [
            'model' => $this->findModelFileLaporan($id),
        ]);
    }

    /**
     * Creates a new SakipKategoriFile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateFileLaporan($id_kategori)
    {
        $model = new SakipKategoriFile();
        $model->id_kategori = $id_kategori;

        if ($model->load(Yii::$app->request->post()) && $model->simpan()) {
            return $this->redirect(['view-kategori', 'id' => $model->id_kategori]);
        } else {
            return $this->render('sakip-file-laporan/create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SakipKategoriFile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdateFileLaporan($id)
    {
        $model = $this->findModelFileLaporan($id);

        if ($model->load(Yii::$app->request->post()) && $model->simpan()) {
            return $this->redirect(['view-kategori', 'id' => $model->id_kategori]);
        } else {
            return $this->render('sakip-file-laporan/update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SakipKategoriFile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteFileLaporan($id)
    {
    	$model = $this->findModelFileLaporan($id);
    	$id_kategori = $model->id_kategori;
        $model->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the SakipKategoriFile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SakipKategoriFile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelFileLaporan($id)
    {
        if (($model = SakipKategoriFile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
