<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
// use yii\captcha\Captcha;
// use yii\widgets\LinkPager;
use yii\web\View;

$this->title = 'Pengajuan Industri';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs(
    "$('#btn-list').on('click', function() {
        // alert('Button clicked!');
        $('#industri').hide();
        $('#daftar-industri').show();

    });",
    View::POS_READY,
    'my-button-handler'
);

// $this->registerJsFile("@web/js/industri.js",['depends' => 'yii\web\JqueryAsset']);
?>
<div class="list-page">
    <div class="box-content">
        <div class="box-header">
            <div class="pull-right box-tools"><a href="#" class="btn btn-sm btn-default btn-flat" id="btn-list">Lihat Daftar Industri Anda disini</a></div>
        </div>
        <div class="box-body padding" id="industri">
            <div class="form">
                <div class="title">Silahkan isi masukkan anda dibawah ini:</div>
                 <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model_form_bukutamu, 'name') ?>

                    <?= $form->field($model_form_bukutamu, 'email') ?>

                    <?= $form->field($model_form_bukutamu, 'subject')->textInput(['readOnly'=> true]) ?>

                    <?= $form->field($model_form_bukutamu, 'body')->textArea(['rows' => 6]) ?>

                    <!-- <?= $form->field($model_form_bukutamu, 'reCaptcha')->widget(
                        \himiklab\yii2\recaptcha\ReCaptcha::className(),
                        ['siteKey' => '6LeIaRIUAAAAANL1ghU-DGEWI0a42ddw7AXclJgt']
                    ) ?> -->

                    <div class="form-group">
                        <?= Html::submitButton('<i class="fa fa-send"></i> Kirim', ['class' => 'btn btn-flat btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div class="box-body padding" id="daftar-industri" hidden>
            <div class="form">
                <div class="title">Silahkan isi masukkan npwp perusahaan anda dibawah ini:</div>
                 <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model_form_bukutamu, 'name') ?>

                    <div class="form-group">
                        <?= Html::submitButton('Kirim', ['class' => 'btn btn-flat btn-primary', 'name' => 'contact-button']) ?>
                        <a href=""><button type='button' class='btn btn-flat btn-warning'>Batal</button>
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