<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\HalamanProfil */

$this->title = 'Tambah Subbag';
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
  	<li>Manage Pegawai</li>
    <li><i class="fa fa-circle-o"></i> Unit Kerja</li>
    <li><a href="index">Daftar Bidang</a></li>
    <li><a href="view?id=<?= $model->id_bidang ?>"><?= $model->bidang->nama ?></a></li>
    <li class="active">Tambah Subbag</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
    	<div class="box-header">
          <div class="pull-right box-tools"><a href="view?id=<?= $model->id_bidang ?>" class="btn btn-sm btn-default btn-flat">Kembali</a></div>
        </div>
        <div class="box-body">

		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>

		</div>
	</div>
</section>