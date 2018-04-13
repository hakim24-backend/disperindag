<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AlbumPhoto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="album-photo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'jdl_album')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aktif')->dropDownList([ 'Y' => 'Aktifkan', 'N' => 'Non-Aktifkan', ], ['prompt' => 'Pilih Status']) ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-flat btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
