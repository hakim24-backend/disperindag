<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SakipKategoriFile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sakip-kategori-file-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    
    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?php if(!$model->isNewRecord && $model->file!=NULL){ ?>
    <div class="form-group">
        <label class="control-label">File pada saat ini</label><br>
        
        <a target="blank" href="<?= Yii::$app->request->baseUrl ?>/..<?= Yii::$app->params['uploadUrlFile'].$model->file ?>">
            <?= $model->file ?>
        </a>
        
    </div>
    <span style="color:red">(*NB: Jika tidak ingin mengganti file, biarkan input file upload dan link url kosong)</span>
    <?php } ?>

    <?= $form->field($model, 'file_upload')->fileInput() ?>
    <div class="help-block" style="margin-top:-15px">
        Ukuran maksimal file adalah 20 MB<br>
        Format file yang diperbolehkan adalah pdf, zip, rar
    </div>

    <div style="border:dotted 1px #ccc; padding:10px;">
    <?= $form->field($model, 'url')->textInput(['maxlength' => true])->label("Link url download yang mengarah ke file laporan (optional)") ?>
    <div class="help-block" style="margin-top:-15px">
        Optional, jika Anda tidak dapat mengupload file laporan di sini, dikarenakan maksimal ukuran file atau format extension file, anda bisa upload ditempat lain, dan memasukkan link url download yang mengarah ke file laporan tersebut<br>
    </div>
    </div>
    <br>
    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-flat btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
