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

$this->registerJsFile("@web/frontend/web/js/bukutamu.js",['depends' => 'yii\web\JqueryAsset']);
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


<div class="list-page">
    <div class="box-content">
        <div class="box-body padding">

          <?php
            echo '<label class="control-label">Pilihan Jenis Buku Tamu</label>';
            echo Select2::widget([
              'name' => 'drop_jenis',
              'id' => 'drop_jenis',
              'data' => ['Buku Tamu', 'Pendaftaran Industri'],
              'options' => [
                  'placeholder' => 'Pilih jenis buku tamu',
              ],
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
            <div class="form">
              <div class="title">Silahkan isi buku tamu dibawah ini:</div><br>
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
