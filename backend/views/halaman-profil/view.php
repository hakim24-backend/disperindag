<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HalamanProfil */

$this->title = "Detail Halaman Profil";
$urlPreview = "/../profile/about?content="
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
     <li><i class="fa fa-flag"></i> Halaman Profil</li>
    <li class="active">Detail</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-header">
          <?= Html::a('Update', ['update', 'id' => $model->id_halaman], ['class' => 'btn btn-flat btn-primary']) ?>
          <?= Html::a('Delete', ['delete', 'id' => $model->id_halaman], [
              'class' => 'btn btn-flat btn-danger',
              'data' => [
                  'confirm' => 'Are you sure you want to delete this item?',
                  'method' => 'post',
              ],
          ]) ?>
          <span class=" preview-website">
              <a href="<?= Yii::$app->request->baseUrl.$urlPreview.$model->slug ?>" class="btn btn-flat btn-default" target="blank">Lihat halaman ini di website</a>
          </span>
          <div class="pull-right box-tools"><a href="index" class="btn btn-sm btn-default btn-flat">Kembali</a></div>
        </div>
        <div class="box-body">
            <div class="single-page">
                <div class="judul"><?= $model->judul ?></div>
                <div class="info">Diposting pada <?= $model->tgl_posting ?></div>
                <div class="article"><?= $model->isi_halaman ?></div>
            </div>
        </div>
    </div>
</section>