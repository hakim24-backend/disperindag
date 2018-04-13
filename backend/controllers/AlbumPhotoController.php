<?php

namespace backend\controllers;

use Yii;
use common\models\AlbumPhoto;
use common\models\Photo;
use backend\models\AlbumPhotoSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\components\MainController;
use backend\components\AccessRule;

/**
 * AlbumPhotoController implements the CRUD actions for AlbumPhoto model.
 */
class AlbumPhotoController extends MainController
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
                    'delete-photo' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all AlbumPhoto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AlbumPhotoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AlbumPhoto model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $photos = Photo::find()->where(['id_album'=>$id])->orderBy(['id_gallery'=>SORT_DESC])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'photos' => $photos,
        ]);

        
    }

    /**
     * Creates a new AlbumPhoto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AlbumPhoto();

        if ($model->load(Yii::$app->request->post()) && $model->simpan()) {
            return $this->redirect(['view', 'id' => $model->id_album]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AlbumPhoto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_album]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AlbumPhoto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $dirPath = '..'.Yii::$app->params['uploadUrlGallery'].$model->album_seo."-".md5($model->id_album.Yii::$app->params['specialChar1']);

        $model->delete();

        $model->deleteFolder($dirPath);

        return $this->redirect(['index']);
    }

    /**
     * Finds the AlbumPhoto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AlbumPhoto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if(Yii::$app->user->identity->level=='admin')
            $model = AlbumPhoto::findOne($id);
        else
            $model = AlbumPhoto::find()->where(['user_id'=>Yii::$app->user->identity->username,'id_album'=>$id])->one();

        if ($model !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    /**----------------------- PHOTO ----------------------------**/
    /**
     * Displays a single Photo model.
     * @param integer $id
     * @return mixed
     */
    public function actionViewPhoto($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Photo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatePhoto($id_album)
    {
        $model = new Photo();
        $model->scenario = "create";
        $model->id_album = $id_album;

        if ($model->load(Yii::$app->request->post()) && $model->simpan()) {
            return $this->redirect(['view', 'id' => $model->id_album]);
        } else {
            return $this->render('photo/create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Photo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdatePhoto($id)
    {
        $model = $this->findModelPhoto($id);
        $model->scenario = "update";

        if ($model->load(Yii::$app->request->post()) && $model->simpan()) {
            return $this->redirect(['view', 'id' => $model->id_album]);
        } else {
            return $this->render('photo/update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Photo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeletePhoto($id)
    {
        
        $model = $this->findModelPhoto($id);
        $id_album = $model->id_album;

        $img_show = $model->getPath("show").$model->gbr_gallery;
        $img_thumb = $model->getPath("thumb").$model->gbr_gallery;

        $model->delete();

        $model->deleteFilePhoto($img_thumb);
        $model->deleteFilePhoto($img_show);

        return $this->redirect(['view', 'id' => $id_album]);
    }

    /**
     * Finds the Photo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Photo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelPhoto($id)
    {   
        $model = Photo::findOne($id);
        if(Yii::$app->user->identity->level!='admin'){
            if($model->album->user_id != Yii::$app->user->identity->username){
                $model = null;
            }
        }
            

        if ($model !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
