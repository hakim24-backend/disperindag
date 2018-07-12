<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Industri */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="industri-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'badan_usaha')->textInput() ?>

    <?= $form->field($model, 'nama_perusahaan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_pemilik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jalan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kelurahan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kecamatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telepon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'web')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'izin_usaha_industri')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tahun_izin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kbli')->textInput() ?>

    <?= $form->field($model, 'komoditi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenis_produk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cabang_industri')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tahun_data')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tk_lk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tk_pr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nilai_investasi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jml_kapasitas_produksi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'satuan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nilai_produksi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nilai_bb_bp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'orientasi_ekspor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'negara_tujuan_ekspor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'npwp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
