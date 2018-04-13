<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Identitas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="identitas-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'nama_website')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_deskripsi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_keyword')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
    	<label class="control-label">Gambar favicon saat ini</label><br>
    	<img src="<?= Yii::$app->request->baseUrl ?>/..<?= Yii::$app->params['uploadUrlOther'].$model->favicon ?>">
    </div>
    <span style="color:red">(*NB: Jika tidak ingin mengganti gambar favicon, biarkan file input kosong)</span>
    <?= $form->field($model, 'imageFile')->fileInput() ?>
    <p class="help-block">Format yang diperbolehkan png/jpg.<br>ukuran yang direkomendasikan 64 X 64 px.</p>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
