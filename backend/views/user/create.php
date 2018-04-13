<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Tambah User';
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-database"></i> Data Master</li>
    <li><a href="index">Manajemen User</a></li>
    <li class="active">Tambah Baru</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-header">
          <div class="pull-right box-tools"><a href="index" class="btn btn-sm btn-default btn-flat">Kembali</a></div>
        </div>
        <div class="box-body">

  		    <div class="user-form">

              <?php $form = ActiveForm::begin(['options'=>['autocomplete'=>'off']]); ?>

              <?= $form->field($model, 'username')->textInput() ?>
              <?= $form->field($model, 'password')->passwordInput() ?>
              <?= $form->field($model, 'nama_lengkap')->textInput() ?>
              <?= $form->field($model, 'email')->textInput() ?>
              <?= $form->field($model, 'no_telp')->textInput(['minlength' => true]) ?>
              <?= $form->field($model, 'status_blokir')->dropDownList([ 'N' => 'Aktif', 'Y' => 'Non-aktif', ], ['prompt' => 'Pilih status']) ?>
              
              <div class="form-group">
                  <?= Html::submitButton('Simpan', ['class' => 'btn btn-flat btn-primary']) ?>
              </div>

              <?php ActiveForm::end(); ?>

          </div>

		</div>
	</div>
</section>
