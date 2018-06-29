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

?>
<div class="list-page">
    <div class="box-content">
        <div class="box-body padding" id="form-industri">
            <div class="form">
                <div class="title">Silahkan isi masukkan anda dibawah ini:</div>
                <?= $form->field($model, 'npwp')->textInput(['maxlength' => true]) ?>
                
                <?= $form->field($model, 'izin_usaha_industri')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'tahun_izin')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'kbli')->textInput() ?>

                <?= $form->field($model, 'komoditi')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'jenis_produk')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'cabang_industri')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'tahun_data')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'tk_lk')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'tk_pr')->textInput(['maxlength' => true]) ?>

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