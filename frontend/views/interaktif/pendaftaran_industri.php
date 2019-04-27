<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use common\models\BadanUsaha;
use common\models\Villages;
use common\models\Districts;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\widgets\LinkPager;
use yii\widgets\DetailView;
use yii\web\View;
use yii\web\JsExpression;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\widgets\Pjax;

use kartik\money\MaskMoney;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use kartik\daterange\DateRangePicker;
use kartik\date\DatePicker;
$this->registerJsFile("@web/frontend/web/js/sweetalert.js",['depends' => 'yii\web\JqueryAsset']);
$this->registerJsFile("@web/frontend/web/js/industri.js",['depends' => 'yii\web\JqueryAsset']);
$this->registerJsFile("@web/frontend/web/js/datatable.js",['depends' => 'yii\web\JqueryAsset']);
$this->registerJsFile("@web/frontend/web/js/maskinput.js",['depends' => 'yii\web\JqueryAsset']);
// $this->registerCssFile("@web/frontend/web/css/datatable.js", ['depends' => 'yii\bootstrap\BootstrapAsset']);
$url =  Yii::$app->request->baseUrl. '/interaktif/kbli-list';
$badanUsaha=ArrayHelper::map(BadanUsaha::find()->orderBy(['nama_badan_usaha' => SORT_ASC])->asArray()->all(), 'id', 'nama_badan_usaha');
$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php

  Modal::begin([
      'header'=>'<h4>KBLI</h4>',
      'id'=>'modal',
      'size'=>'modal-lg',
      'options' => [
        'style' => ['z-index' => '9999']
      ],
      'closeButton' => [
        'id'=>'close-button',
        'class'=>'close',
        'data-dismiss' =>'modal',
      ],
   ]);
?>
<!--   // Pjax::begin();
  // echo GridView::widget([
  //    'dataProvider' => $providerKBLI,
  //    'filterModel' => $searchModel,
  //    'columns' => [
  //         [
  //           'attribute' => 'id',
  //           'label' => 'Nomor',
  //           'contentOptions' => [
  //             'id' => 'val_id',
  //             'class' => 'val_id',
  //           ],
  //         ],
  //         [
  //           'attribute' => 'kode',
  //           'label' => 'Kode',
  //           'contentOptions' => [
  //             'id' => 'val_kode',
  //             'class' => 'val_kode',
  //           ],
  //         ],
  //         [
  //           'attribute' => 'nama',
  //           'label' => 'Nama',
  //           'contentOptions' => [
  //             'id' => 'val_nama',
  //             'class' => 'val_nama',
  //           ],
  //         ],
  //        [
  //        'class' => 'yii\grid\ActionColumn',
  //          'template' => '{pilih}',
  //          'options' => ['width' => '120'],
  //          'buttons' => [
  //            'pilih' => function ($model) {
  //              return Html::button('Pilih', ['class' => 'btn btn-info teaser']);
  //            },
  //          ],
  //        ],
  //    ],
  // ]);
  // Pjax::end(); -->
<div id="p0" data-pjax-container="" data-pjax-push-state="" data-pjax-timeout="1000">
    <div id="w0" class="table-responsive">
        <table class="table table-striped table-bordered responsive-utilities jambo_table kbli">
            <thead>
                <tr class="headings">
                    <th width="5%">Nomor</th>
                    <th width="5%">Kode</th>
                    <th width="20%">Nama</th>
                    <th class="action-column" width="5%">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              foreach ($providerKBLI as $key => $value) { ?>
                <tr data-key="<?=$no?>">
                    <td id="val_id" class="val_id" width="5%"><?= $value->id ?></td>
                    <td id="val_kode" class="val_kode" width="5%"><?= $value->kode ?></td>
                    <td id="val_nama" class="val_nama" width="20%"><?= $value->nama ?></td>
                    <td width="5%">
                        <button type="button" class="btn btn-info teaser">Pilih</button>
                    </td>
                </tr>
              <?php 
              $no++;
              } ?>
            </tbody>
        </table>
    </div>
</div>
<?php
  Modal::end();
?>


<div class="list-page">
    <div class="box-content">
        <div class="box-header">
            <div onclick="showBukuTamu()" class="pull-right box-tools"><a href="#" class="btn btn-sm btn-default btn-flat" id="btn-list" style="display: none">Lihat Daftar Industri Anda disini</a></div>
        </div>
        <div class="box-body padding" id="form-industri">
            <div class="form">
                  <?php $form = ActiveForm::begin(['action' => 'industrisave/']); ?>
                    <div id="form-1">
                        <?= $form->field($model, 'badan_usaha')->dropDownList(
                            $badanUsaha,           // Flat array ('id'=>'label')
                            ['prompt'=>'Pilih Badan Usaha Perusahaan Anda', 'required'=>true]    // options
                        ) ?>

                        <!-- <?= $form->field($model, 'komoditi')->textInput(['maxlength' => true, 'required'=>true]) ?> -->

                        <?= $form->field($model, 'nama_perusahaan')->textInput(['maxlength' => true, 'required'=>true]) ?>

                        <?= $form->field($model, 'nama_pemilik')->textInput(['maxlength' => true, 'required'=>true]) ?>

                        <?= $form->field($model, 'jalan')->textInput(['maxlength' => true, 'required'=>true]) ?>

                        <?= $form->field($model, 'kecamatan')->widget(Select2::classname(), [
                            'data' => Districts::getDistricts(),
                            'options' => ['placeholder' => 'Pilih Kecamatan...', 'id'=>'id-cat','required'=>true],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]) ?>

                        <?= $form->field($model, 'kelurahan')->widget(Select2::classname(), [
                            'data' => [],
                            'options' => ['placeholder' => 'Pilih Kelurahan...', 'id'=>'id-subcat','required'=>true],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]) ?>

                        <!-- <?= $form->field($model, 'kecamatan')->dropDownList(Districts::getDistricts(),
                        ['prompt'=>'Pilih Kecamatan...','id'=> 'cat-id', 'required'=>true])?>

                        <?= $form->field($model, 'kelurahan')->widget(DepDrop::classname(), [
                            'options'=>['id'=>'subcat-id','prompt'=>'Pilih Kelurahan...', 'required'=>true],
                            'pluginOptions'=>[
                                'depends'=>['cat-id'],
                                'placeholder'=>'Pilih Kelurahan...',
                                'url'=>Url::to(['interaktif/subcat'])
                            ]
                        ])?> -->

                        <?= $form->field($model, 'telepon')->textInput(['maxlength' => true,'type' => 'number']) ?>

                        <?= $form->field($model, 'fax')->textInput(['maxlength' => true,'required' => 'true','type' => 'number']) ?>

                        <?= $form->field($model, 'email')->hiddenInput(['value'=>'-'])->label(false); ?>

                        <?= $form->field($model, 'web')->textInput(['maxlength' => true,'required' => 'true']) ?>

                            <div id="button-kasir-next-1" style="display:in-line;">
                                  <div onclick="myFunctionNext1()" class="tombol-next" style="color:#40e854;border:1px solid #CCC;background:#4CAF50;cursor:pointer;vertical-align:middle;width: 100px;padding: 5px;text-align: center;">
                                    <font color="white">Lanjut</font>
                                    <a href="#" class="fill-div"></a>
                                  </div>
                            </div>

                    </div>

                    <div id="form-2" style="display: none;">
                        <!-- <?= $form->field($model, 'npwp')->textInput(['type' => 'text' , 'pattern'=>'[0-9]','maxlength' => true, 'placeholder' => 'Contoh : 1234567890', 'required'=>true])->label('Nomor Pokok Wajib Pajak') ?> -->

                        <?= $form->field($model, 'npwp')->widget(yii\widgets\MaskedInput::class, 
                          [
                            'mask' => '99.999.999.9-999.999',
                          ]
                        ) ?>

                        <?= $form->field($model, 'izin_usaha_industri')->dropDownList(
                            [
                                '0' => 'Belum',
                                '1' => 'TDI',
                                '2' => 'IUI',
                                '3' => 'IUMK',
                                '4' => 'Izin Lainnya'
                            ,],['required'=>true])->label('Legalitas Industri') ?>

                        <?= $form->field($model, 'tahun_izin')->widget(DatePicker::classname(), [
                                'name' => 'filter_date',
                                'options' => ['placeholder' => 'Pilih Tahun Izin ...', 'required'=>true],
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                    'startView'=>'year',
                                    'minViewMode'=>'years',
                                    'format' => 'yyyy'
                                  ]
                        ]) ?>

                        <?= Html::label('KBLI') ?>
                        <?= Html::textInput('txt_kbli', NULL, ['class' => 'form-control', 'id' => 'txt_kbli']) ?>

                        <?= $form->field($model, 'kbli')->hiddenInput(['id'=>'txt_kbli_val', 'required'=>true])->label(false); ?>

                        <?= Html::label('Komoditi') ?>
                        <?= Html::textInput('industri-komoditi', NULL, ['class' => 'form-control', 'id' => 'industri-komoditi', 'readonly' => true]) ?>

                        <?= $form->field($model, 'komoditi')->hiddenInput(['id'=>'industri-komoditi', 'required'=>true])->label(false); ?>

                        <?= $form->field($model, 'jenis_produk')->textInput(['maxlength' => true, 'required'=>true]) ?>

                        <?= $form->field($model, 'cabang_industri')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'tahun_data')->widget(DatePicker::classname(), [
                                'name' => 'filter_date',
                                'options' => ['placeholder' => 'Pilih Tahun Izin ...', 'required'=>true],
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                    'startView'=>'year',
                                    'minViewMode'=>'years',
                                    'format' => 'yyyy'
                                  ]
                            ]) ?>

                        <?= $form->field($model, 'tk_lk')->textInput(['maxlength' => true, 'required'=>true, 'type'=>'number'])->label('Tenaga Kerja Laki-Laki') ?>

                        <?= $form->field($model, 'tk_pr')->textInput(['maxlength' => true, 'required'=>true,'type'=>'number'])->label('Tenaga Kerja Perempuan') ?>

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

                        <?= $form->field($model, 'nilai_investasi')->widget(MaskMoney::classname(), 
                          [
                            'pluginOptions' => [
                                'prefix' => 'Rp. ',
                                'suffix' => '',
                                'affixesStay' => true,
                                'thousands' => '.',
                                'decimal' => ',',
                                'precision' => 0, 
                                'allowZero' => false,
                                'allowNegative' => false,
                          ]
                        ]) ?>
                        
                        <!-- <?= $form->field($model, 'nilai_investasi')->textInput(['maxlength' => true, 'required'=>true,'placeholder' => 'Rp. ']) ?> -->

                        <?= $form->field($model, 'jml_kapasitas_produksi')->textInput(['maxlength' => true, 'required'=>true, 'type' => 'number']) ?>

                        <?= $form->field($model, 'satuan')->textInput(['maxlength' => true, 'required'=>true]) ?>

                        <?= $form->field($model, 'nilai_produksi')->textInput(['maxlength' => true, 'required'=>true,'type' => 'number']) ?>

                        <?= $form->field($model, 'nilai_bb_bp')->textInput(['maxlength' => true, 'required'=>true,'type' => 'number']) ?>

                        <?= $form->field($model, 'orientasi_ekspor')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'negara_tujuan_ekspor')->widget(Select2::classname(), [
                            'data' => $country,
                            'options' => ['placeholder' => 'Pilih Negara Tujuan Ekspor...', 'required'=>true],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]) ?>

                        <!-- <?= $form->field($model, 'negara_tujuan_ekspor')->textInput(['maxlength' => true]) ?> -->

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

<?php 
  
$this->registerJs("

  $('#id-cat').on('change', function() {
  var id = $('#id-cat').val();
    $.ajax({
      url : '" . Yii::$app->urlManager->baseUrl."/interaktif/get-subcat?id='+id,
      dataType : 'html',
      success: function (data) {
        $('#id-subcat').html(data);
      }
    })
  });

  $('#industri-komoditi').on('change',function(){
    alert('hai');
  });

  $('#industri-telepon').on('change',function(){
    var data = $('#industri-telepon').val();
    if($.isNumeric(data) == true){
        return true;
      } else {
        swal('Nomor Telepon Harus Angka');
      }
  });

  $('#industri-fax').on('change',function(){
    var data = $('#industri-fax').val();
    if($.isNumeric(data) == true){
        return true;
      } else {
        swal('Fax Harus Angka');
      }
  });
 
");

?>