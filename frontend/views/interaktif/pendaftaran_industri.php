<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use backend\models\BadanUsaha;
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

use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use kartik\daterange\DateRangePicker;
use kartik\date\DatePicker;

$this->registerJsFile("@web/frontend/web/js/industri.js",['depends' => 'yii\web\JqueryAsset']);
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
  Pjax::begin();
  echo GridView::widget([
     'dataProvider' => $providerKBLI,
     'filterModel' => $searchModel,
     'columns' => [
          [
            'attribute' => 'id',
            'label' => 'Nomor',
            'contentOptions' => [
              'id' => 'val_id',
              'class' => 'val_id',
            ],
          ],
          [
            'attribute' => 'kode',
            'label' => 'Kode',
            'contentOptions' => [
              'id' => 'val_kode',
              'class' => 'val_kode',
            ],
          ],
          [
            'attribute' => 'nama',
            'label' => 'Nama',
            'contentOptions' => [
              'id' => 'val_nama',
              'class' => 'val_nama',
            ],
          ],
         [
         'class' => 'yii\grid\ActionColumn',
           'template' => '{pilih}',
           'options' => ['width' => '120'],
           'buttons' => [
             'pilih' => function ($model) {
               return Html::button('Pilih', ['class' => 'btn btn-info teaser']);
             },
           ],
         ],
     ],
  ]);
  Pjax::end();

  Modal::end();
?>

<div class="list-page">
    <div class="box-content">
        <div class="box-header">
            <h3 class="title">Buku Tamu</h3>
        </div>
        <div class="box-body">
            <div class="list-comment">
                <?php foreach ($list_comment as $key => $item) { ?>
                        <div class="item">
                            <div class="text1"><?= $item->nama ?></div>
                            <div class="date"><?= $item->tanggal ?></div>
                            <div>
                                <?php if($item->getStatus()==0): ?>
                                    <span class="label label-default">Menunggu Tanggapan</span>
                                <?php else: ?>
                                    <span class="label label-success">Sudah Ditanggapi</span>
                                <?php endif; ?>
                            </div>
                            <div class="text2">
                            <strong><?= $item->subjek ?></strong><br>
                            <?= nl2br($item->pesan) ?>
                            </div>
                        </div>
                <?php } ?>
                <div class="box-footer">
                    <?php
                        echo LinkPager::widget([
                            'pagination' => $pages,
                            'maxButtonCount' => 5,
                        ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="list-page">
    <div class="box-content">
        <div class="box-header">
            <div onclick="showBukuTamu()" class="pull-right box-tools"><a href="#" class="btn btn-sm btn-default btn-flat" id="btn-list" style="display: none">Lihat Daftar Industri Anda disini</a></div>
        </div>
        <div class="box-body padding" id="form-industri">
            <div class="form">
                <?php $form = ActiveForm::begin(['action' => 'industrisave/']); ?>
                  <div id="form-daftar" style="display: none">
                      <div class="title">Silahkan isi masukkan npwp perusahaan anda dibawah ini:</div>
                      <br>
                      <?= Html::textInput('txt_search_npwp', NULL, ['class' => 'form-control', 'id' => 'txt_search_npwp', 'placeholder' => 'Contoh : 123456789 atau PT. Mega Bangkrut']) ?>
                      <br>
                      <br>
                      <?= DetailView::widget([
                          'model' => $model,
                          'attributes' => [
                              [
                                'attribute' => 'npwp',
                                'label' => 'Nomor Pokok Wajib Pajak',
                                'contentOptions' => [
                                  'id' => 'val_npwp'
                                ],
                                'value' => function($model){
                                  if($model->npwp != null){
                                    return $model->npwp;
                                  }else{
                                    return '-';
                                  }
                                }
                              ],
                              [
                                'attribute' => 'nama_perusahaan',
                                'label' => 'Nama Perusahaan',
                                'contentOptions' => [
                                  'id' => 'val_nama_perusahaan'
                                ],
                                'value' => function($model){
                                  if($model->nama_perusahaan != null){
                                    return $model->npwp;
                                  }else{
                                    return '-';
                                  }
                                }
                              ],
                          ],
                      ]) ?>
                      <div id="button-buku-back" style="display:in-line;padding-top: 10px;">
                        <div onclick="bukuTamuBack()" class="tombol-next" style="color:#40e854;border:1px solid #CCC;background:#999999;cursor:pointer;vertical-align:middle;width: 100px;padding: 10px;text-align: center;">
                          <font color="white">Kembali</font>
                          <a href="#" class="fill-div"></a>
                        </div>
                      </div>
                      <div class="detail-perusahaan" style="padding-top: 10px;"></div>
                  </div>


                    <div id="form-1">
                        <?= $form->field($model, 'badan_usaha')->dropDownList(
                            $badanUsaha,           // Flat array ('id'=>'label')
                            ['prompt'=>'Pilih Badan Usaha Perusahaan Anda', 'required'=>true]    // options
                        ) ?>

                        <?= $form->field($model, 'nama_perusahaan')->textInput(['maxlength' => true, 'required'=>true]) ?>

                        <?= $form->field($model, 'nama_pemilik')->textInput(['maxlength' => true, 'required'=>true]) ?>

                        <?= $form->field($model, 'jalan')->textInput(['maxlength' => true, 'required'=>true]) ?>

                        <?= $form->field($model, 'kecamatan')->dropDownList(Districts::getDistricts(),
                        ['prompt'=>'Pilih Kecamatan...','id'=> 'cat-id', 'required'=>true])?>

                        <?= $form->field($model, 'kelurahan')->widget(DepDrop::classname(), [
                            'options'=>['id'=>'subcat-id','prompt'=>'Pilih Kelurahan...', 'required'=>true],
                            'pluginOptions'=>[
                                'depends'=>['cat-id'],
                                'placeholder'=>'Pilih Kelurahan...',
                                'url'=>Url::to(['interaktif/subcat'])
                            ]
                        ])?>

                        <?= $form->field($model, 'telepon')->textInput(['maxlength' => true, 'required' => 'true']) ?>

                        <?= $form->field($model, 'fax')->textInput(['maxlength' => true, 'required' => 'true']) ?>

                        <?= $form->field($model, 'email')->hiddenInput(['value'=>'-'])->label(false); ?>

                        <?= $form->field($model, 'web')->textInput(['maxlength' => true, 'required' => 'true']) ?>

                            <div id="button-kasir-next-1" style="display:in-line;">
                                  <div onclick="myFunctionNext1()" class="tombol-next" style="color:#40e854;border:1px solid #CCC;background:#4CAF50;cursor:pointer;vertical-align:middle;width: 100px;padding: 5px;text-align: center;">
                                    <font color="white">Lanjut</font>
                                    <a href="#" class="fill-div"></a>
                                  </div>
                            </div>

                    </div>

                    <div id="form-2" style="display: none;">
                        <?= $form->field($model, 'npwp')->textInput(['min'=>'1' ,'type' => 'number' ,'maxlength' => true, 'placeholder' => 'Contoh : 1234567890', 'required'=>true])->label('Nomor Pokok Wajib Pajak') ?>

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

                        <?= $form->field($model, 'komoditi')->textInput(['maxlength' => true, 'required'=>true]) ?>

                        <?= $form->field($model, 'jenis_produk')->textInput(['maxlength' => true, 'required'=>true]) ?>

                        <?= $form->field($model, 'cabang_industri')->textInput(['maxlength' => true, 'required'=>true]) ?>

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

                        <?= $form->field($model, 'tk_lk')->textInput(['maxlength' => true, 'required'=>true]) ?>

                        <?= $form->field($model, 'tk_pr')->textInput(['maxlength' => true, 'required'=>true]) ?>

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
                        <?= $form->field($model, 'nilai_investasi')->textInput(['maxlength' => true, 'required'=>true]) ?>

                        <?= $form->field($model, 'jml_kapasitas_produksi')->textInput(['maxlength' => true, 'required'=>true]) ?>

                        <?= $form->field($model, 'satuan')->textInput(['maxlength' => true, 'required'=>true]) ?>

                        <?= $form->field($model, 'nilai_produksi')->textInput(['maxlength' => true, 'required'=>true]) ?>

                        <?= $form->field($model, 'nilai_bb_bp')->textInput(['maxlength' => true, 'required'=>true]) ?>

                        <?= $form->field($model, 'orientasi_ekspor')->textInput(['maxlength' => true, 'required'=>true]) ?>

                        <?= $form->field($model, 'negara_tujuan_ekspor')->textInput(['maxlength' => true, 'required'=>true]) ?>
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
