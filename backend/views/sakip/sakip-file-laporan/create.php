<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SakipKategoriFile */

$this->title = 'Tambah File Laporan '.$model->kategori->nama;
?>
<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
     <li><a href="index"><i class="fa fa-briefcase"></i> SAKIP</a></li>
     <li><a href="view-kategori?id=<?= $model->id_kategori ?>">Detail Kategori Laporan</a></li>
     <li class="active">Tambah File Laporan</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
    	<div class="box-header">
    		<div class="pull-right box-tools"><a href="<?= Yii::$app->request->baseUrl ?>/sakip/view-kategori?id=<?= $model->id_kategori ?>" class="btn btn-sm btn-default btn-flat">Kembali</a></div>
    	</div>
        <div class="box-body">

		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>

		</div>
	</div>
</section>