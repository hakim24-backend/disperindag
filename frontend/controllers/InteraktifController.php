<?php

namespace frontend\controllers;

use frontend\components\MainController;
use common\models\LinkTerkait;
use common\models\Contact;
use common\models\Districts;
use common\models\Villages;
use common\models\Industri;
use common\models\Kbli;
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
    public function actionIndustri()
    {

        $model_form_bukutamu = new ContactForm();
        $model= new Industri();
        $selectionPerusahaan = Industri::selectionPerusahaan();

        $model_form_bukutamu->subject='Pengajuan Industri Baru';
        // $model->tahun_izin = date("Y");
        // $model->tahun_data = date("Y");

        if ($model_form_bukutamu->load(Yii::$app->request->post()) && $model->load(Yii::$app->request->post())) {
            $model->status=0;
            $isValid = $model_form_bukutamu->validate();

            $isValid = $model->validate() && $isValid;
            // var_dump($isValid);die;

            if ($isValid) {

                $model_form_bukutamu->saveAs();
                $model->save();
                return $this->refresh();
            }
        }
        
        return $this->render('form-industri', [
            'model_form_bukutamu' => $model_form_bukutamu,
            'selectionPerusahaan' => $selectionPerusahaan,
            'model' => $model,
            
        ]);


        // if ($model_form_bukutamu->load(Yii::$app->request->post())&&$model->load(Yii::$app->request->post())) {
        //     if($model_form_bukutamu->validate() && $model->validate()){
        //         // $model_form_bukutamu->save();
        //         if ($model_form_bukutamu->save()) {
        //             # code...
        //             var_dump("expression");die();
        //             if ($model->save()) {
        //                 # code...
        //                 var_dump("expression2");die();

        //             }else{
        //                 var_dump("expression4");die();
        //             }
        //         }else{
        //             var_dump("expression3");die();

        //         }
        //         return $this->refresh();
                
        //     }

        // }
        // if (Yii::$app->request->post()) {
        //     # code...
        //     var_dump(Yii::$app->request->post());die();
        // }
        // return $this->render('form-industri', [
        //     'model_form_bukutamu' => $model_form_bukutamu,
        //     'selectionPerusahaan' => $selectionPerusahaan,
        //     'model' => $model,
            
        // ]);
    }

    public function actionSubcat() 
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = Villages::getSubCatList($cat_id); 
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                return json_encode(['output'=>$out, 'selected'=>'']);
            }
        }
        return json_encode(['output'=>'', 'selected'=>'']);
    }


    public function actionKblilist($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select('id, name AS text')
                ->from('kbli')
                ->where(['like', 'name', $q])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Kbli::find($id)->name];
        }
        return $out;
    }

}
