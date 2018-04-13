<?php

namespace frontend\controllers;

use frontend\components\MainController;
use common\models\Agenda;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\data\Pagination;

class AgendaController extends MainController
{

	/**
	 * Menampilkan semua list agenda
     * @return mixed
     */
	public function actionIndex()
	{
		$list_agenda = Agenda::find()
						->orderBy(['tgl_mulai'=>SORT_DESC]);
		$countQuery = clone $list_agenda;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>1]);
        $list_agenda_page = $list_agenda->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
		return $this->render('index',[
			'list_agenda' => $list_agenda_page,
            'pages'=>$pages,
		]);
	}

	/**
	 * Menampilkan detail agenda
	 * @param string $content url slug
     * @return mixed
     */
    public function actionDetail($content)
    {
    	$model_agenda = $this->findModelAgenda($content);
        return $this->render('detail',[
        	'model_agenda' => $model_agenda,
        ]);
    }


    /**
     * Finds the Projects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $slug Url Slug
     * @return Projects the loaded model
     * @throws BadRequestHttpException if the model cannot be found
     */
    protected function findModelAgenda($slug)
    {
        if (($model = Agenda::find()->where(['tema_seo'=>$slug])->one()) !== null) {
            return $model;
        } else {
            throw new BadRequestHttpException('Halaman yang Anda cari tidak ditemukan');
        }
    }
}
