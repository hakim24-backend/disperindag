<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\KataSensor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kata-sensor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kata')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ganti')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-flat btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
