<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Download */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="download-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    
    <?= $form->field($model, 'id_kategori')->dropDownList($model->getAllKetegori(),['prompt'=>'Pilih kategori...']) ?>

    <?= $form->field($model, 'judul')->textInput(['maxlength' => true]) ?>

    <?php if(!$model->isNewRecord && $model->nama_file!=NULL){ ?>
    <div class="form-group">
        <label class="control-label">File pada saat ini</label><br>
        
        <a target="blank" href="<?= Yii::$app->request->baseUrl ?>/<?= $model->getPath().$model->nama_file ?>">
            <?= $model->nama_file ?>
        </a>
        
    </div>
    <span style="color:red">(*NB: Jika tidak ingin mengganti file, biarkan input file upload kosong)</span>
    <?php } ?>

    <?= $form->field($model, 'file_download')->fileInput() ?>
    <div class="help-block" style="margin-top:-15px">
        Ukuran maksimal file adalah 20 MB<br>
        Format file yang diperbolehkan adalah pdf, zip, rar
    </div>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-flat btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
