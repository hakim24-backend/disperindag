<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LinkTerkaitSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="link-terkait-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_banner') ?>

    <?= $form->field($model, 'judul') ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'gambar') ?>

    <?= $form->field($model, 'tgl_posting') ?>

    <?php // echo $form->field($model, 'id_kategori') ?>

    <?php // echo $form->field($model, 'keterangan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
