<?php

namespace frontend\controllers;

use frontend\components\MainController;
use common\models\LinkTerkait;
use common\models\Contact;
use frontend\models\ContactForm;
use Yii;
use yii\data\Pagination;
use frontend\models\FeedbackForm;
class InteraktifController extends MainController
{
    /**
     * Menampilkan list link terkait
     * @return mixed
     */
    public function actionLinkTerkait()
    {
        $list_link_terkait = LinkTerkait::find()
        						->all();
        return $this->render('link-terkait',[
        	'list_link_terkait' => $list_link_terkait,
        ]);
    }

    /**
     * Menampilkan halaman buku tamu
     * Menampilkan semua list record buku tamu
     * Proses post buku tamu
     * @return mixed
     */
    public function actionContact()
    {
    	$model_form_comment = new ContactForm();
        if ($model_form_comment->load(Yii::$app->request->post())) {
        	if($model_form_comment->validate() && $model_form_comment->saveAs())
            	Yii::$app->session->setFlash('success', 'Terimakasih telah mengisi buku tamu kami, kami akan merespon pesan Anda ini segera mungkin melalui email Anda.');
            else
            	Yii::$app->session->setFlash('error', 'Error');
            return $this->refresh();
        }

    	$list_comment = Contact::find()
    						->where(['tampilkan'=>'Y'])
    						->orderBy(['id_hubungi'=>SORT_DESC]);
    	$countQuery = clone $list_comment;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>3]);
        $list_comment_page = $list_comment->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('contact', [
            'model_form_comment' => $model_form_comment,
            'list_comment' => $list_comment_page,
            'pages' => $pages,
        ]);
    }
	public function actionFeedback()
    {
        $model_form_feedback = new FeedbackForm();
        // var_dump($model_form_feedback); die();
        if ($model_form_feedback->load(Yii::$app->request->post())) {
            if($model_form_feedback->validate() && $model_form_feedback->saveAs())
                Yii::$app->session->setFlash('success', 'Terimakasih atas masukkan Anda');
            else
                Yii::$app->session->setFlash('error', 'Error');
            return $this->refresh();
        }
        return $this->render('feedback', [
            'model_form_feedback' => $model_form_feedback,
        ]);
    }
}
