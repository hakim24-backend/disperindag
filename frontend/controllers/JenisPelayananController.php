<?php

namespace frontend\controllers;

use frontend\components\MainController;
use common\models\JenisPelayanan;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

class JenisPelayananController extends MainController
{
	/**
	* Menampilkan list jenis pelayanan
	* @return mixed
	*/
    public function actionIndex()
    {
        $list_jenis_pelayanan = JenisPelayanan::find()->all();
        return $this->render('index',[
        	'list_jenis_pelayanan' => $list_jenis_pelayanan,
        ]);
    }

    /**
	* Menampilkan detail pelayanan
	* @param string $content : slug url
	* @return mixed
	*/
	public function actionDetail($content)
    {
    	$model_jenis_pelayanan = $this->findModel($content);
        return $this->render('detail',[
    		'model_jenis_pelayanan'=>$model_jenis_pelayanan,
    	]);
    }

    /**
     * Finds the Projects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $slug Url Slug
     * @return Projects the loaded model
     * @throws BadRequestHttpException if the model cannot be found
     */
    protected function findModel($slug)
    {
        if (($model = JenisPelayanan::find()->where(['slug'=>$slug])->one()) !== null) {
            return $model;
        } else {
            throw new BadRequestHttpException('Halaman yang Anda cari tidak ditemukan');
        }
    }
}
