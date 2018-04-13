<?php

namespace frontend\controllers;

use frontend\components\MainController;
use common\models\UptIndag;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\data\Pagination;

class UptIndagController extends MainController
{
	/**
	* Menampilkan list pelayana UPT INDAG
	* @return mixed
	*/
    public function actionIndex()
    {
    	$list_upt_indag = UptIndag::find()
    				->select(['judul','tgl_posting','gambar','slug']);
    	
        $countQuery = clone $list_upt_indag;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>16]);
        $list_upt_indag_page = $list_upt_indag->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index',[
            'pages'           => $pages,
    		'list_upt_indag'  => $list_upt_indag_page,
    	]);
    }

    /**
	* Menampilkan detail UPT INDAG
	* @param integer $content : slug url
	* @return mixed
	*/
	public function actionDetail($content)
    {
    	$model_upt_indag = $this->findModel($content);
        return $this->render('detail',[
    		'model_upt_indag'=>$model_upt_indag,
    	]);
    }

    /**
     * Finds the Projects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $slug Url slug
     * @return Projects the loaded model
     * @throws BadRequestHttpException if the model cannot be found
     */
    protected function findModel($slug)
    {
        if (($model = UptIndag::find()->where(['slug'=>$slug])->one()) !== null) {
            return $model;
        } else {
            throw new BadRequestHttpException('Halaman yang Anda cari tidak ditemukan');
        }
    }
}
