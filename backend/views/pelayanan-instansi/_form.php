<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use backend\assets\TextareaAsset;

//TextareaAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\PelayananInstansi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pelayanan-instansi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'diskripsi')->textarea(['rows' => 6])->label("Diskripsi Singkat") ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>