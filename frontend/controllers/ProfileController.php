<?php
namespace frontend\controllers;

use Yii;
use frontend\components\MainController;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\HalamanProfil;

/**
 * Site controller
 */
class ProfileController extends MainController
{

    public function actionIndex()
    {
        $model = HalamanProfil::find()->select(['judul','slug'])->all();
        return $this->render('index',[
            'model'=>$model,
        ]);
    }
	/**
	* Menampilkan konten dari profil
	* @param integer $content : slug url
	* @return mixed
	*/
	public function actionAbout($content)
    {
    	$model_profile = $this->findModel($content);
        return $this->render('content',[
    		'model_profile'=>$model_profile,
    	]);
    }

    /**
     * Finds the Projects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id Url Slug
     * @return Projects the loaded model
     * @throws BadRequestHttpException if the model cannot be found
     */
    protected function findModel($slug)
    {
        if (($model = HalamanProfil::find()->where(['slug'=>$slug])->one()) !== null) {
            return $model;
        } else {
            throw new BadRequestHttpException('Halaman yang Anda cari tidak ditemukan');
        }
    }
}