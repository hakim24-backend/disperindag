<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Photo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="photo-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?php if(!$model->isNewRecord){ ?>
    <div class="form-group">
        <label class="control-label">Foto saat ini</label><br>
        <div class="preview-image-update-form img-thumbnail">
        <img src="<?= Yii::$app->request->baseUrl ."/". $model->getPath("thumb").$model->gbr_gallery ?>">
        </div>
    </div>
    <span style="color:red">(*NB: Jika tidak ingin mengganti Foto, biarkan file input Foto kosong)</span>
    <?php } ?>
    <?= $form->field($model, 'imageFile')->fileInput() ?>
    <span class="help-block image">Format yang diperbolehkan jpg, png</span>

    <?= $form->field($model, 'jdl_gallery')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-flat btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
