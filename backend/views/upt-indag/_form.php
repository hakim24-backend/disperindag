<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\TextareaAsset;

TextareaAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\UptIndag */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="upt-indag-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    
    <?= $form->field($model, 'judul')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'isi_halaman')->textarea(['rows' => 20,'class'=>'tinymce']) ?>

    <?php if(!$model->isNewRecord){ ?>
    <div class="form-group">
    	<label class="control-label">Gambar thumbnail saat ini</label><br>
    	<div class="preview-image-update-form img-thumbnail">
    	<img src="<?= Yii::$app->request->baseUrl ?>/..<?= Yii::$app->params['uploadUrlOther'].$model->gambar ?>">
    	</div>
    </div>
    <span style="color:red">(*NB: Jika tidak ingin mengganti gambar thumbnail, biarkan file input Gambar Thumbnail kosong)</span>
    <?php } ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>
    <span style="margin-bottom: 20px;margin-top: -10px" class="help-block">
    Rekomendasi minimal lebar gambar 800px</span>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
