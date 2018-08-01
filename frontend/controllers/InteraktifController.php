<?php

namespace frontend\controllers;

use yii\widgets\DetailView;

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
        $model->tahun_izin = date("Y");
        $model->tahun_data = date("Y");
        $model->status = 0;
        if ($model_form_bukutamu->load(Yii::$app->request->post()) && $model->load(Yii::$app->request->post())) {
            $model->status=0;
            $isValid = $model_form_bukutamu->validate();
            $isValid = $model->validate() && $isValid;

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

    public function actionKbliList($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new \yii\db\Query;

            $query->select('id, kode AS kode')
                ->from('kbli')
                ->where(['like', 'kode', $q])
                ->limit(20);

            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'name' => Kbli::find($id)->kode];
        }
        return $out;
    }


    public function actionInfo(){

      $id = $_POST['id'];
      $model = Industri::find()->andFilterWhere(['id'=>$id])->one();
      // var_dump($model);die();
      echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    // 'jalan',
                    [
                        'attribute'=>'status',
                        'format'=>'raw',
                        'value' => $model->getStatus(),
                    ],
                    [
                        'attribute' => 'badanUsaha.nama_badan_usaha',
                        'value' => $model->badan_usaha != null ? $model->badanUsaha->nama_badan_usaha : '-',
                    ],
                    [
                        'attribute' => 'nama_perusahaan',
                        'value' => $model->nama_perusahaan != null ? $model->nama_perusahaan : '-',
                    ],
                    [
                        'attribute' => 'nama_pemilik',
                        'value' => $model->nama_pemilik != null ? $model->nama_pemilik : '-',
                    ],
                    [
                        'label' => 'Alamat',
                        'attribute'=>'jalan',
                        'value' => $model->jalan != null ? $model->jalan : '-',
                    ],
                    [
                        'attribute' => 'kelurahan',
                        'value' => $model->kelurahan != null ? Villages::find()->where(['id'=>$model->kelurahan])->one()->name : '-',
                    ],
                    [
                        'attribute' => 'kecamatan',
                        'value' => $model->kecamatan != null ? Districts::find()->where(['id'=>$model->kecamatan])->one()->name : '-',
                    ],
                    [
                        'label' => 'No. telp',
                        'attribute'=>'telepon',
                        'value' => $model->telepon != null ? $model->telepon : '-',

                    ],
                    [
                        'attribute' => 'fax',
                        'value' => $model->fax != null ? $model->fax : '-',
                    ],
                    [
                        'attribute' => 'email',
                        'value' => $model->email != null ? $model->email : '-',
                    ],
                    [
                        'attribute' => 'web',
                        'value' => $model->web != null ? $model->web : '-',
                    ],
                    [
                        'attribute' => 'izin_usaha_industri',
                        'value' => function($model) {
                            if($model->izin_usaha_industri != NULL){
                                if ($model->izin_usaha_industri==0) {
                                    return 'belum';
                                }else if ($model->izin_usaha_industri==1) {
                                    return 'TDI';
                                }else if ($model->izin_usaha_industri==2) {
                                    return 'IUI';
                                }else if ($model->izin_usaha_industri==3) {
                                    return 'IUMK';
                                }else if ($model->izin_usaha_industri==4) {
                                    return 'IZIN LAINNYA';
                                }
                            }else{

                                return '-';
                            }
                        },
                    ],
                    [
                        'attribute' => 'tahun_izin',
                        'value' => $model->tahun_izin != null ? $model->tahun_izin : '-',
                    ],
                    [
                        'label' => 'Nama KBLI',
                        'attribute' => 'kbli0.nama',
                        'value' => $model->kbli != null ? $model->kbli0->nama : '-',
                    ],
                    [
                        'attribute' => 'komoditi',
                        'value' => $model->komoditi != null ? $model->komoditi : '-',
                    ],
                    [
                        'attribute' => 'jenis_produk',
                        'value' => $model->jenis_produk != null ? $model->jenis_produk : '-',
                    ],
                    [
                        'attribute' => 'cabang_industri',
                        'value' => $model->cabang_industri != null ? $model->cabang_industri : '-',
                    ],
                    [
                        'label' => 'TK LK',
                        'attribute' => 'tk_lk',
                        'value' => $model->tk_lk != null ? $model->tk_lk : '-',
                    ],
                    [
                        'label' => 'TK PR',
                        'attribute' => 'tk_pr',
                        'value' => $model->tk_pr != null ? $model->tk_pr : '-',
                    ],
                    [
                        'attribute' => 'nilai_investasi',
                        'value' => $model->nilai_investasi != null ? $model->nilai_investasi : '-',
                    ],
                    [
                        'attribute' => 'jml_kapasitas_produksi',
                        'value' => $model->jml_kapasitas_produksi != null ? $model->jml_kapasitas_produksi : '-',
                    ],
                    [
                        'attribute' => 'satuan',
                        'value' => $model->satuan != null ? $model->satuan : '-',
                    ],
                    [
                        'attribute' => 'nilai_produksi',
                        'value' => $model->nilai_produksi != null ? $model->nilai_produksi : '-',
                    ],
                    [
                        'attribute' => 'nilai_bb_bp',
                        'value' => $model->nilai_bb_bp != null ? $model->nilai_bb_bp : '-',
                    ],
                    [
                        'attribute' => 'orientasi_ekspor',
                        'value' => $model->orientasi_ekspor != null ? $model->orientasi_ekspor : '-',
                    ],
                    [
                        'attribute' => 'negara_tujuan_ekspor',
                        'value' => $model->negara_tujuan_ekspor != null ? $model->negara_tujuan_ekspor : '-',
                    ],
                    [
                        'attribute' => 'npwp',
                        'value' => $model->npwp != null ? $model->npwp : '-',
                    ],
                ],
            ]);
    }

}
