<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
// use yii\captcha\Captcha;
// use yii\widgets\LinkPager;
use yii\web\View;

$this->title = 'Feedback';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="list-page">
    <div class="box-content">
        <div class="box-body padding">
            <div class="form">
                <div class="title">Silahkan isi masukkan anda dibawah ini:</div>
                <?php $form = ActiveForm::begin(['id' => 'feedback-form']); ?>

                    <?= $form->field($model_form_feedback, 'nama') ?>

                    <?= $form->field($model_form_feedback, 'email') ?>

                    <?= $form->field($model_form_feedback, 'subject') ?>

                    <?= $form->field($model_form_feedback, 'feedback')->textArea(['rows' => 6]) ?>

                    <?= $form->field($model_form_feedback, 'reCaptcha')->widget(
                        \himiklab\yii2\recaptcha\ReCaptcha::className(),
                        ['siteKey' => '6LeIaRIUAAAAANL1ghU-DGEWI0a42ddw7AXclJgt']
                    ) ?>

                    <div class="form-group">
                        <?= Html::submitButton('<i class="fa fa-send"></i> Kirim', ['class' => 'btn btn-flat btn-primary', 'name' => 'contact-button']) ?>
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