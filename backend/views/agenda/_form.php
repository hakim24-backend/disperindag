<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\InputMaskAsset;
use backend\assets\TextareaAsset;

TextareaAsset::register($this);
InputMaskAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\Agenda */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agenda-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pengirim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tema')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'isi_agenda')->textarea(['rows' => 6,'class'=>'tinymce']) ?>

    <?= $form->field($model, 'tempat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_mulai')->textInput(['class'=>'form-control datemask','readonly'=>'true']) ?>

    <?= $form->field($model, 'tgl_selesai')->textInput(['class'=>'form-control datemask','readonly'=>'true']) ?>

    <?= $form->field($model, 'jam')->textInput(['class'=>'form-control timepicker']) ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-flat btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
