<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Kbli */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kbli-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode')->textInput(['maxlength' => true, 'required'=>true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'required'=>true]) ?>
    
    <?= $form->field($model, 'deskripsi')->textInput(['maxlength' => true, 'required'=>true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
