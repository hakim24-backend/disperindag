<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Update Profil';
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li class="active"><i class="fa fa-user"></i> Profil</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-body">

  		    <div class="user-form">

              <?php $form = ActiveForm::begin(['options'=>['autocomplete'=>'off']]); ?>

              <?= $form->field($model, 'username')->textInput(['disabled'=>'disabled']) ?>
              <?= $form->field($model, 'password')->passwordInput() ?>
              <p style="margin-top: -10px; color: red" class="help-block">*Apabila password tidak diubah, dikosongkan saja.</p>
              <?= $form->field($model, 'nama_lengkap')->textInput() ?>
              <?= $form->field($model, 'email')->textInput() ?>
              <?= $form->field($model, 'no_telp')->textInput() ?>
              <?= $form->field($model, 'status_blokir')->dropDownList([ 'N' => 'Aktif', 'Y' => 'Non-aktif', ], ['prompt' => 'Pilih status']) ?>

              <div class="form-group">
                  <?= Html::submitButton('Simpan', ['class' => 'btn btn-flat btn-primary']) ?>
              </div>

              <?php ActiveForm::end(); ?>

          </div>
		    </div>
	</div>
</section>
