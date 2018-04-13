<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\TextareaAsset;

TextareaAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'judul')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_kategori')->dropDownList($model->getAllKetegoriPost(),['prompt'=>'Pilih kategori post...']) ?>

    <?php if(!$model->isNewRecord){ ?>
    <div class="form-group">
        <label class="control-label">Gambar saat ini</label><br>
        <div class="preview-image-update-form img-thumbnail">
        <img src="<?= Yii::$app->request->baseUrl ?>/..<?= Yii::$app->params['uploadUrlPost']."thumb/medium_".$model->gambar ?>">
        </div>
    </div>
    <span style="color:red">(*NB: Jika tidak ingin mengganti gambar thumbnail, biarkan file input Gambar Thumbnail kosong)</span>
    <?php } ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>
    <span class="help-block image">Rekomendasi minimal ukuran lebar gambar 800px<br> Dengan maksimal size memori gambar 400 KB</span>

    <?= $form->field($model, 'isi_berita')->textarea(['rows' => 20, 'class'=>'tinymce']) ?>

    <?= $form->field($model, 'tag')->checkboxList($model->getAllTag(),['class'=>'tages']) ?>

    
    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-flat btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
