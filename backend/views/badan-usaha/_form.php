<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BadanUsaha */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="badan-usaha-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_badan_usaha')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
