<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\TextareaAsset;

TextareaAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\SakipKategori */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sakip-kategori-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'judul')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'deskripsi')->textarea(['rows' => 6,'class'=>'tinymce']) ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-flat btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>