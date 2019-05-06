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
use common\models\KbliSearch;
use common\models\BlokIp;
use common\models\Country;
use common\models\Unit;
use common\models\Regencies;


use frontend\models\ContactForm;
use Yii;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;
use frontend\models\FeedbackForm;
use yii\helpers\ArrayHelper;

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
        //data industri
        $industri = ArrayHelper::map(Industri::find()->all(), 'nama_perusahaan', 'nama_perusahaan');

        $model_form_comment = new ContactForm();
        if ($model_form_comment->load(Yii::$app->request->post())) {
            if($model_form_comment->validate())

                if($this->cekBlokir() == true) {
                    Yii::$app->session->setFlash('warning', 'Maaf Anda tidak bisa mengirim pesan sekarang!');
                }else if($this->KataJelek($model_form_comment->body)) {
                    Yii::$app->session->setFlash('warning', 'Maaf komentar anda mengandung kata yang tidak pantas, komentar Anda tidak ditampilkan.');
                    $this->BlokirIP();
                }else{

                    if($model_form_comment->saveAs()) {
                        Yii::$app->session->setFlash('success', 'Terimakasih telah mengisi buku tamu kami, kami akan merespon pesan Anda ini segera mungkin melalui email Anda.');
                    }
                }
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

        $model = new Industri();

        return $this->render('contact', [
            'model_form_comment' => $model_form_comment,
            'list_comment' => $list_comment_page,
            'pages' => $pages,
            'industri' => $industri,
            'model' => $model
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

    public function actionSearchnpwp($query){
      $model = Industri::find()->select(['npwp', 'nama_perusahaan'])->where(['npwp' => $query])->asArray()->one();
      if($model == null){
        $model = Industri::find()->select(['npwp', 'nama_perusahaan'])->where(['nama_perusahaan' => $query])->asArray()->one();
      }
      echo json_encode($model);
    }

    public function actionIndustrisave(){

        //data unit
        $unit = ArrayHelper::map(Unit::find()->all(), 'name_unit', 'name_unit');

        //data kabupaten
        $kabupaten = ArrayHelper::map(Regencies::find()->all(), 'id', 'name');

        $email = \Yii::$app->session->get('name');
        #data kbli
        $providerKBLI = KBLI::find()->all();
        #buku tamu load
        $model_form_comment = new ContactForm();
        $list_comment = Contact::find()
                        ->where(['tampilkan'=>'Y'])
                        ->orderBy(['id_hubungi'=>SORT_DESC]);
        $countQuery = clone $list_comment;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>3]);
        $list_comment_page = $list_comment->offset($pages->offset)
          ->limit($pages->limit)
          ->all();
        #industri load
        $model= new Industri();
        $model->tahun_izin = date("Y");
        $model->tahun_data = date("Y");
        $model->status = 0;
        $selectionPerusahaan = Industri::selectionPerusahaan();

        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();
            $model->email = $email;
            $model->status=0;
            $model->kbli = intval($model->kbli);
            $model->komoditi = $post['industri-komoditi'];

            if ($model->izin_usaha_industri == 4) {
                $model->izin_usaha_industri = $post['form-baru'];
            }

            $isValid = $model->validate();
        
            if ($isValid) {
                Yii::$app->session->setFlash('success', 'Terimakasih telah mengisi pendaftaran industri.');
                $model->save(false);
                return Yii::$app->response->redirect(['interaktif/contact']);
            }
        }

        return $this->render('pendaftaran_industri', [
            'model_form_comment' => $model_form_comment,
            'list_comment' => $list_comment_page,
            'pages' => $pages,
            'selectionPerusahaan' => $selectionPerusahaan,
            'model' => $model,
            'providerKBLI' => $providerKBLI,
            'unit' => $unit,
            'kabupaten' => $kabupaten
        ]);
    }

    public function actionPendaftaransave(){
      $model_form_comment = new ContactForm();
      if ($model_form_comment->load(Yii::$app->request->post())) {
        if($model_form_comment->validate()){
            #buku tamu load
            // $model_form_comment = new ContactForm();
            // $list_comment = Contact::find()
            //                     ->where(['tampilkan'=>'Y'])
            //                     ->orderBy(['id_hubungi'=>SORT_DESC]);
            // $countQuery = clone $list_comment;
            // $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>3]);
            // $list_comment_page = $list_comment->offset($pages->offset)
            //     ->limit($pages->limit)
            //     ->all();
            // #industri load
            // $model= new Industri();
            // $selectionPerusahaan = Industri::selectionPerusahaan();
            $post = Yii::$app->request->post();
            // if (!Yii::$app->session->getIsActive()) {
            //     Yii::$app->session->open();
            // }
            // $session = Yii::$app->session;

            // // the following code will NOT work
            // if (isset($post['ContactForm']['email'])) {
            //     $session['email-user'] = $post['ContactForm']['email'];
            // }else{
            //     $session['email-user'] = '-';
            // }
            \Yii::$app->session->set('name',$post['ContactForm']['email']);

            // var_dump(\Yii::$app->session->get('name'));die;
            // the following code also works:
            return Yii::$app->response->redirect(['interaktif/industrisave']);

        }else{
            Yii::$app->session->setFlash('error', 'Error');
            return $this->redirect(Yii::$app->request->referrer);
        }
      }
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
                var_dump($out);die();
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

    public function actionGetCat($id)
    {
        if ($id != null) {
            
            //data kecamatan
            $data = Districts::find()->where(['regency_id'=>$id])->all();

            if ($data) {
                foreach ($data as $datas) {
                    echo "<option value='".$datas['id']."'>".$datas['name']."</option>";
                }
            } else {
                echo "<option value=0>Pilih Kecamatan ...</option>";
            }

        } else {

        }
    }

    public function actionGetSubcat($id)
    {
        if ($id != null) {

            //data kelurahan
            $data = Villages::getSubCatList($id);

            //get kelurahan with looping
            if ($data) {
                foreach ($data as $datas) {
                    echo "<option value='".$datas['id']."'>".$datas['name']."</option>";   
                }
            }
        } else {
            echo "<option value=0>Pilih kelurahan ...</option>";
        }
    }

    public function actionNewForm()
    {
        echo '
            <input type="text" class="form-control" name="form-baru" maxlength="100" required="" aria-required="true">
            <br>
        ';
    }

    public function actionGetCountry($id)
    {
        if ($id == 3) {
            $data = Country::find()->all();

            foreach ($data as $datas) {
                echo "<option value='".$datas['Name']."'>".$datas['Name']."</option>";
            }
        } else {
            echo "<option value=0>Pilih Negara Tujuan Ekspor ...</option>";
        }
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
    public function actionPilih($id)
    {
      var_dump($id);
      // code...
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


    private function KataJelek($kata)
    {
        //open from file
        $path = './'.Yii::$app->params['uploadUrlOther'];
        $path = str_replace("/","\\", $path);
        $my_file = $path.'badword.txt';
        $data = "";

        if(file_exists($my_file)){
            if(filesize($my_file) > 0){
                $handle = fopen($my_file, 'r');
                $data = fread($handle,filesize($my_file));
                fclose($handle);
            }
        }
        $kata_kotor = explode(",", $data);

        $count = 0;

        $jml_kata = count($kata_kotor);
        
        for ($i = 0; $i < $jml_kata; $i++)
        {
            if ( stristr($kata, $kata_kotor[$i]))
            { 
                $count = 1; 
                break;
            }
        }

        return $count;
    }

    private function BlokirIP()//BlokIP()
    {
        $lamanya  = 60;
        $time     = new \DateTime(date("Y-m-d H:i:s"));
        $time->add(new \DateInterval('PT' . $lamanya . 'M'));
        $duration = $time->format('Y-m-d H:i:s');
        $ip = $_SERVER['REMOTE_ADDR'];
        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            $ip = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
        }

        $blokir   = new BlokIp();
        $blokir->ip_address = $ip;
        $blokir->sampai = $duration;
        $blokir->ket = "kata tidak pantas";
        $blokir->status = 1;
        $blokir->save();

    }

    private function cekBlokir()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            $ip = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
        }
        $userIP = BlokIp::find()
            ->where(['ip_address' => $ip])
            ->andWhere(['status' => 1])
            ->one();
        if($userIP) {
            $date1 = new \DateTime(date("Y-m-d H:i:s"));
            $date2 = new \DateTime($userIP->sampai);
            if($date1 < $date2) {
                return true;
            }else{
                //buka blokir;
                $userIP->status = 3;
                $userIP->save(false);
                return false;
            }
        }

        return false;
    }

    public function actionBlokir()
    {
       $ip = $_SERVER['REMOTE_ADDR'];
        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            $ip = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
        }
        $userIP = BlokIp::find()
            ->where(['ip_address' => $ip])
            ->andWhere(['status' => 1])
            ->one();
        if($userIP) {
            $date1 = new \DateTime(date("Y-m-d H:i:s"));
            $date2 = new \DateTime($userIP->sampai);
            if($date1 < $date2) {
                echo "on";
            }else{
                //buka blokir;
                echo "buka";
            }
        }
    }

}
