<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\widgets\LinkPager;
use yii\web\View;
use kartik\select2\Select2;
use yii\widgets\DetailView;


$this->registerJsFile("@web/frontend/web/js/bukutamu.js",['depends' => 'yii\web\JqueryAsset']);
$this->registerJsFile("@web/frontend/web/js/sweetalert.js",['depends' => 'yii\web\JqueryAsset']);
$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
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


<div class="list-page" id="contact-bottom">
    <div class="box-content">
        <div class="box-body padding">

          <?php
            echo '<label class="control-label">Pilihan Jenis Buku Tamu</label>';
      echo Html::radioList('drop_jenis', 0, ['Buku Tamu', 'Pendaftaran Industri'], 
              [
                'id'=>'drop_jenis',
                'itemOptions' => [ 'style'=> 'margin-left: 1em' ]
            ]);
          ?>
          <br>
          <div id="form-bukutamu">
            <div class="form">
              <div class="title">Silahkan isi buku tamu dibawah ini:</div><br>
                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                  <?= $form->field($model_form_comment, 'name') ?>

                  <?= $form->field($model_form_comment, 'email') ?>

                  <?= $form->field($model_form_comment, 'subject')->textInput() ?>

                  <?= $form->field($model_form_comment, 'body')->textArea(['rows' => 6]) ?>

                  <?= $form->field($model_form_comment, 'reCaptcha')->widget(
                      \himiklab\yii2\recaptcha\ReCaptcha::className(),
                      ['siteKey' => '6LeIaRIUAAAAANL1ghU-DGEWI0a42ddw7AXclJgt']
                  ) ?>
                <div class="form-group">
                    <?= Html::submitButton('<i class="fa fa-send"></i> Kirim', ['class' => 'btn btn-flat btn-primary', 'name' => 'contact-button', 'i' => 'btn_submit', 'id' => 'btn_submit']) ?>
                </div>
              <?php ActiveForm::end(); ?>
            </div>
          </div>

          <div id="form-pendaftaranindustri">
            <div class="box-header">
              <div onclick="showDaftarPerusahaan()" class="pull-right box-tools"><a href="#contact-bottom" class="btn btn-sm btn-default btn-flat" id="btn-list">Lihat Daftar Industri Anda disini</a></div>
            </div>
            <br>
            <div class="form" id="bukutamu">
              <div class="title">Silahkan daftarkan perusahaan anda dibawah ini:</div><br>
                <?php $form = ActiveForm::begin(['id' => 'form-pendaftaranindustri', 'action' => 'pendaftaransave/']); ?>

                  <?= $form->field($model_form_comment, 'name') ?>

                  <?= $form->field($model_form_comment, 'email') ?>

                  <?= $form->field($model_form_comment, 'subject')->hiddenInput(['value'=>'Pendaftaran Industri'])->label(false); ?>

                  <?= $form->field($model_form_comment, 'body')->hiddenInput(['value'=>'-'])->label(false); ?>

                  <?= $form->field($model_form_comment, 'reCaptcha')->widget(
                      \himiklab\yii2\recaptcha\ReCaptcha::className(),
                      ['siteKey' => '6LeIaRIUAAAAANL1ghU-DGEWI0a42ddw7AXclJgt']
                  ) ?>
                  <div class="form-group">
                      <?= Html::submitButton('<i class="fa fa-send"></i> Kirim', ['class' => 'btn btn-flat btn-primary', 'name' => 'contact-button', 'i' => 'btn_submit', 'id' => 'btn_submit']) ?>
                  </div>
              <?php ActiveForm::end(); ?>
            </div>
          </div>
          <div id="form-daftar" style="display: none">
            <div class="title">Silahkan isi masukkan npwp perusahaan anda dibawah ini:</div>
            <br>
            <div class="form-group">
            <!-- <?= Html::textInput('txt_search_npwp', NULL, ['class' => 'form-control', 'id' => 'txt_search_npwp', 'placeholder' => 'Contoh : 123456789 atau PT. XYZ, tekan tombol enter untuk mencari']) ?> -->

            <?= Select2::widget([
                'name' => 'txt_search_npwp',
                'data' => $industri,
                'options' => ['placeholder' => 'Contoh : 123456789 atau PT. XYZ', 'id' => 'txt_search_npwp'],
                'pluginOptions' => [
                    'allowClear' => true
                 ],
            ])?>
            </div>
            <!-- <div class="form-group">
              <?= Html::Button('Kembali', ['class' => 'btn btn-flat btn-warning', 'name' => 'contact-button', 'id' => 'btn_back']) ?>
            </div> -->
            <div id="data-missing">
            </div>
            <div id="button-buku-back" style="display:in-line;padding-top: 10px;">
              <div onclick="perusahaanBack()" class="tombol-next" style="color:#40e854;border:1px solid #CCC;background:#999999;cursor:pointer;vertical-align:middle;width: 100px;padding: 10px;text-align: center;">
                <font color="white">Kembali</font>
                <a href="#contact-bottom" class="fill-div"></a>
              </div>
            </div>
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
            
            <div class="detail-perusahaan" style="padding-top: 10px;"></div>
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
            }else if(Yii::$app->session->getFlash('warning')) {
                echo '<div class="alert alert-warning" role="alert">';
                echo "Error";
            }else{
                echo '<div class="alert alert-danger" role="alert">';
                echo "Error";
            }
            ?>
            !</strong> <?= Yii::$app->session->getFlash('success') ?><?= Yii::$app->session->getFlash('error') ?><?= Yii::$app->session->getFlash('warning')?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
if(Yii::$app->session->getFlash('success') != null){
    $this->registerJs("$('#myModal').modal('show');", View::POS_END);
}
if(Yii::$app->session->getFlash('warning') != null){
    $this->registerJs("$('#myModal').modal('show');", View::POS_END);
}
?>

<?php

$this->registerJs("

  $('#txt_search_npwp').on('change',function(){
      $.ajax({
          url : '../interaktif/searchnpwp?query='+$(this).val(),
          dataType : 'json',
          type : 'post'
      }).done(function(data){
        if (!$.trim(data)){
          $('#val_npwp').html('-');
          $('#val_nama_perusahaan').html('-');
        }
        else{
          $('#val_npwp').html(data.npwp);
          $('#val_nama_perusahaan').html(data.nama_perusahaan)
          $('#data-missing').html('');
        }
      });
  });
 
");

?>