<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

<<<<<<< HEAD

// The controller action that will render the list
$url =  Yii::$app->request->baseUrl. '/interaktif/kbli-list';
//$url = \yii\helpers\Url::to(['/interaktif/kbli-list']);
=======
// The controller action that will render the list

$url = \yii\helpers\Url::to(['/industri/kbli-list']);
>>>>>>> 18add4c9bb3606ccd7e15a1701fb7ff68c547e73

// The widget

use yii\bootstrap\ActiveForm;
use yii\web\View;
use yii\web\JsExpression;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

use backend\models\BadanUsaha;
use common\models\Villages;
use common\models\Districts;

use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
<<<<<<< HEAD
use kartik\daterange\DateRangePicker;
=======

>>>>>>> 18add4c9bb3606ccd7e15a1701fb7ff68c547e73

$this->title = 'Pengajuan Industri';
$this->params['breadcrumbs'][] = $this->title;

$badanUsaha=ArrayHelper::map(BadanUsaha::find()->orderBy(['nama_badan_usaha' => SORT_ASC])->asArray()->all(), 'id', 'nama_badan_usaha');

?>
<div class="list-page">
    <div class="box-content">
        <div class="box-header">
            <div onclick="showBukuTamu()" class="pull-right box-tools"><a href="#" class="btn btn-sm btn-default btn-flat" id="btn-list">Lihat Daftar Industri Anda disini</a></div>
        </div>
        <div class="box-body padding" id="form-industri">
            <div class="form">
                <?php $form = ActiveForm::begin(); ?>

                    
                    <div id="form-0">
                        <div class="title">Silahkan isi masukkan anda dibawah ini:</div>

                        <?= $form->field($model_form_bukutamu, 'name')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model_form_bukutamu, 'email')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model_form_bukutamu, 'subject')->textInput(['readOnly'=> true]) ?>

                        <?= $form->field($model_form_bukutamu, 'body')->textArea(['rows' => 6]) ?>

                            <div id="button-kasir-next-0" style="display:in-line;">
                                  <div onclick="myFunctionNext0()" class="tombol-next" style="color:#40e854;border:1px solid #CCC;background:#4CAF50;cursor:pointer;vertical-align:middle;width: 100px;padding: 5px;text-align: center;">
                                    <font color="white">Lanjut</font>
                                    <a href="#" class="fill-div"></a>
                                  </div>
                            </div>

                    </div>


                    <div id="form-daftar" style="display: none">
                        <div class="title">Silahkan isi masukkan npwp perusahaan anda dibawah ini:</div>

                                <?= Select2::widget([
                                    'name' => 'state_2',
                                    'value' => '',
                                    'data' => $selectionPerusahaan,
                                    'options' => ['multiple' => true, 'placeholder' => 'Pilih NPWP / Nama Perusahaan ...']
                                ]) ?>
                                <div id="button-buku-back" style="display:in-line;">
                                      <div onclick="bukuTamuBack()" class="tombol-next" style="color:#40e854;border:1px solid #CCC;background:#999999;cursor:pointer;vertical-align:middle;width: 100px;padding: 5px;text-align: center;">
                                        <font color="white">Kembali</font>
                                        <a href="#" class="fill-div"></a>
                                      </div>
                                </div>



                    </div>


                    <div id="form-1" style="display: none">
                        <?= $form->field($model, 'badan_usaha')->dropDownList(
                            $badanUsaha,           // Flat array ('id'=>'label')
                            ['prompt'=>'Pilih Badan Usaha Perusahaan Anda']    // options
                        ) ?>

                        <?= $form->field($model, 'nama_perusahaan')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'nama_pemilik')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'jalan')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'kecamatan')->dropDownList(Districts::getDistricts(),
                        ['prompt'=>'Pilih Kecamatan...','id'=> 'cat-id'])?>

                        <?= $form->field($model, 'kelurahan')->widget(DepDrop::classname(), [
                            'options'=>['id'=>'subcat-id','prompt'=>'Pilih Kelurahan...'],
                            'pluginOptions'=>[
                                'depends'=>['cat-id'],
                                'placeholder'=>'Pilih Kelurahan...',
                                'url'=>Url::to(['interaktif/subcat'])
                            ]
                        ])?>

                        <?= $form->field($model, 'telepon')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'web')->textInput(['maxlength' => true]) ?>     
                      
                            <div id="button-kasir-next-1" style="display:in-line;">
                                  <div onclick="myFunctionNext1()" class="tombol-next" style="color:#40e854;border:1px solid #CCC;background:#4CAF50;cursor:pointer;vertical-align:middle;width: 100px;padding: 5px;text-align: center;">
                                    <font color="white">Lanjut</font>
                                    <a href="#" class="fill-div"></a>
                                  </div>
                            </div>

                    </div>

                    <div id="form-2" style="display: none;">
                        <?= $form->field($model, 'npwp')->textInput(['maxlength' => true]) ?>
                        
                        <?= $form->field($model, 'izin_usaha_industri')->dropDownList(
                            [
                                '0' => 'Belum', 
                                '1' => 'TDI', 
                                '2' => 'IUI', 
                                '3' => 'IUMK', 
                                '4' => 'Izin Lainnya'
                            ]) ?>

<<<<<<< HEAD
                        <?= $form->field($model, 'tahun_izin')->widget(etsoft\widgets\YearSelectbox::classname(), [
                            'yearStart' => -10,
                            'yearEnd' => 10,
                         ]) ?>



                            <?= $form->field($model, "kbli")->widget(Select2::classname(), [
                                'initValueText' => '', // set the initial display text
                                'options' => ['class'=>'tes','placeholder' => 'Cari Barang ...'],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'minimumInputLength' => 2,
=======
                        <?= $form->field($model, 'tahun_izin')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'kbli')->widget(Select2::classname(), [
                            'options' => ['placeholder' => 'Search for a kbli ...'],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'minimumInputLength' => 3,
>>>>>>> 18add4c9bb3606ccd7e15a1701fb7ff68c547e73
                                'language' => [
                                    'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                                ],
                                'ajax' => [
                                    'url' => $url,
                                    'dataType' => 'json',
<<<<<<< HEAD

                                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                ],
                                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                'templateResult' => new JsExpression('function(kbli) { return kbli.kode; }'),
                                'templateSelection' => new JsExpression('function (kbli) {

                                  if (kbli.nama!=undefined) return kbli.kode;
                                  return kbli.kode; }'),


                            ],
                          ])->label('KBLI'); ?>

=======
                                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                ],
                                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                'templateResult' => new JsExpression('function(kbli) { return kbli.text; }'),
                                'templateSelection' => new JsExpression('function (kbli) { return kbli.text; }'),
                            ],
                        ]) ?>
>>>>>>> 18add4c9bb3606ccd7e15a1701fb7ff68c547e73

                        <?= $form->field($model, 'komoditi')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'jenis_produk')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'cabang_industri')->textInput(['maxlength' => true]) ?>

<<<<<<< HEAD
                        <?= $form->field($model, 'tahun_data')->widget(etsoft\widgets\YearSelectbox::classname(), [
                            'yearStart' => -10,
                            'yearEnd' => 10,
                         ]) ?>
=======
                        <?= $form->field($model, 'tahun_data')->textInput(['maxlength' => true]) ?>
>>>>>>> 18add4c9bb3606ccd7e15a1701fb7ff68c547e73

                        <?= $form->field($model, 'tk_lk')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'tk_pr')->textInput(['maxlength' => true]) ?>  

                        <div class="button-grup-1" style="height: 30px;width: 100%;">
                            <div id="button-kasir-back-1" style="display:in-line;float:left">
                                  <div onclick="myFunctionBack1()" class="tombol-next" style="color:#40e854;border:1px solid #CCC;background:#999999;cursor:pointer;vertical-align:middle;width: 100px;padding: 5px;text-align: center;">
                                    <font color="white">Kembali</font>
                                    <a href="#" class="fill-div"></a>
                                  </div>
                            </div>

                            <div id="button-kasir-next-2" style="display:in-line;float:right;">
                                  <div onclick="myFunctionNext2()" class="tombol-next" style="color:#40e854;border:1px solid #CCC;background:#4CAF50;cursor:pointer;vertical-align:middle;width: 100px;padding: 5px;text-align: center;">
                                    <font color="white">Lanjut</font>
                                    <a href="#" class="fill-div"></a>
                                  </div>
                            </div>
                        </div>

                    </div>
                    <div id="form-3" style="display: none;">
                        <?= $form->field($model, 'nilai_investasi')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'jml_kapasitas_produksi')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'satuan')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'nilai_produksi')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'nilai_bb_bp')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'orientasi_ekspor')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'negara_tujuan_ekspor')->textInput(['maxlength' => true]) ?>
                        <div class="button-grup-2" style="height: 30px;width: 100%;">
                            <div id="button-kasir-back-2" style="display:in-line;float:left">
                                  <div onclick="myFunctionBack2()" class="tombol-next" style="color:#40e854;border:1px solid #CCC;background:#999999;cursor:pointer;vertical-align:middle;width: 100px;padding: 5px;text-align: center;">
                                    <font color="white">Kembali</font>
                                    <a href="#" class="fill-div"></a>
                                  </div>
                            </div>


                            <div id="button-simpan" style="display:in-line;float:right;">                                
                                <div class="form-group">
                                    <?= Html::submitButton('Simpan', ['class' => 'btn btn-flat btn-primary']) ?>
                                </div>
                            </div>
                        </div>
                                
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>


<div id="myModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: none;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
            <strong>
            <?php 
            if(Yii::$app->session->getFlash('success')){
                echo '<div class="alert alert-success" role="alert">';
                echo "Sukses";
            }else{
                echo '<div class="alert alert-danger" role="alert">';
                echo "Error";
            }
            ?>
            !</strong> <?= Yii::$app->session->getFlash('success') ?><?= Yii::$app->session->getFlash('error') ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php 
if(Yii::$app->session->getFlash('success') != null){
    $this->registerJs("$('#myModal').modal('show');", View::POS_END);
}
?>