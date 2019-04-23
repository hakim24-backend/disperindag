<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LinkTerkait */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="link-terkait-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'judul')->textInput(['maxlength' => true, 'required' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true, 'required' => true]) ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 3, 'required' => true, 'maxlength'=>200,'onkeyup'=>'countChar(this)']) ?>
    <div class="count-char-wrep">
        <span id="lenght-char">0</span> / 200
    </div>

    <?php if(!$model->isNewRecord && $model->gambar!=''){ ?>
    <div class="form-group">
        <label class="control-label">Gambar thumbnail saat ini</label><br>
        <div class="preview-image-update-form img-thumbnail">
        <img src="<?= Yii::$app->request->baseUrl ?>/..<?= Yii::$app->params['uploadUrlOther'].$model->gambar ?>">
        </div>
    </div>
    <span style="color:red">(*NB: Jika tidak ingin mengganti gambar thumbnail, biarkan file input Gambar Thumbnail kosong)</span>
    <?php } ?>

    <?= $form->field($model, 'imageFile')->fileInput(['required' => true]) ?>
    <span style="margin-bottom: 20px;margin-top: -10px" class="help-block">
    Rekomendasi ukuran gambar 150 x 150 px</span>
    <?=
    $form->field($model, 'status_menu')->radioList([
        '0' => 'Tidak',
        '1' => 'Ya',
    ]); ?>
    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<style type="text/css">
    #linkterkait-status_menu label{
        margin-right: 20px;
        font-weight: normal;
    }
</style>