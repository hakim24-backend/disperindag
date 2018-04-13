<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\TextareaAsset;

TextareaAsset::register($this);


/* @var $this yii\web\View */
/* @var $model common\models\PelayananInstansiLayanan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pelayanan-instansi-layanan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'diskripsi')->textarea(['rows' => 20,'class'=>'tinymce']) ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-flat btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
