<?php
namespace frontend\controllers;

use Yii;
use frontend\components\MainController;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use common\models\PelayananInstansi;
use common\models\PelayananInstansiLayanan;

/**
 * Site controller
 */
class PelayananController extends MainController
{
    public function actionIndex()
    {
        $model = PelayananInstansi::find()->select(['nama','slug'])->all();
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
    	$model_pelayanan = $this->findModel($content);
        $list_layanan = PelayananInstansiLayanan::find()
                            ->where(['id_pelayanan_instansi'=>$model_pelayanan->id])
                            ->all();
        return $this->render('pelayanan',[
    		'model_pelayanan'     => $model_pelayanan,
            'list_layanan'        => $list_layanan
    	]);
    }


    public function actionLayanan($content)
    {
        $model_layanan = $this->findModelLayanan($content);
        return $this->render('layanan',[
            'model_layanan'       => $model_layanan
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
        if (($model = PelayananInstansi::find()->where(['slug'=>$slug])->one()) !== null) {
            return $model;
        } else {
            throw new BadRequestHttpException('Halaman yang Anda cari tidak ditemukan');
        }
    }

    /**
     * Finds the Projects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id Url Slug
     * @return Projects the loaded model
     * @throws BadRequestHttpException if the model cannot be found
     */
    protected function findModelLayanan($slug)
    {
        if (($model = PelayananInstansiLayanan::find()->where(['slug'=>$slug])->one()) !== null) {
            return $model;
        } else {
            throw new BadRequestHttpException('Halaman yang Anda cari tidak ditemukan');
        }
    }
}