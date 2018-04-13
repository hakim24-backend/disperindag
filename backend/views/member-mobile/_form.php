<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MemberMobile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="member-mobile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->radioList([ 'L' => 'Laki-laki', 'P' => 'Perempuan', ], ['class'=>'radios']) ?>

    <?= $form->field($model, 'alamat')->textArea(['maxlength' => 250]) ?>

    <?= $form->field($model, 'no_telp')->textInput(['maxlength' => true]) ?>

    <?php 
    if($model->isNewRecord){
        echo $form->field($model, 'email')->textInput(['maxlength' => true]);
        echo $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]);
    }else{
        echo $form->field($model, 'email')->textInput(['maxlength' => true,'disabled'=>'disabled']);
    }
    ?>

    <?= $form->field($model, 'status')->dropDownList(['10'=>'Aktif','0'=>'Tidak Aktif'],['prompt'=>'Pilih status']) ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-flat btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
