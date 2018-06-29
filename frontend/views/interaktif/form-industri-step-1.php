<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\BadanUsaha;
// use yii\captcha\Captcha;
// use yii\widgets\LinkPager;
use yii\web\View;

$this->title = 'Pengajuan Industri';
$this->params['breadcrumbs'][] = $this->title;

$badanUsaha=ArrayHelper::map(BadanUsaha::find()->orderBy(['nama_badan_usaha' => SORT_ASC])->asArray()->all(), 'id', 'nama_badan_usaha');
?>
<div class="list-page">
    <div class="box-content">
        <div class="box-body padding" id="form-industri">
            <div class="form">
                <div class="title">Silahkan isi masukkan anda dibawah ini:</div>

                <?= $form->field($model, 'badan_usaha')->dropDownList(
                    $badanUsaha,           // Flat array ('id'=>'label')
                    ['prompt'=>'Pilih Badan Usaha Perusahaan Anda']    // options
                ) ?>

                <?= $form->field($model, 'nama_perusahaan')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'nama_pemilik')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'jalan')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'kelurahan')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'kecamatan')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'telepon')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'web')->textInput(['maxlength' => true]) ?>
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