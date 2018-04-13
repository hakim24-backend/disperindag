<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UptIndagSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="upt-indag-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_halaman') ?>

    <?= $form->field($model, 'slug') ?>

    <?= $form->field($model, 'judul') ?>

    <?= $form->field($model, 'isi_halaman') ?>

    <?= $form->field($model, 'tgl_posting') ?>

    <?php // echo $form->field($model, 'gambar') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
