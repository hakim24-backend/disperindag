<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HalamanProfil */

$this->title = "Detail Jenis Pelayanan";
$urlPreview = "/../profile/about?content="
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="index"><i class="fa fa-heart-o"></i> Pelayanan</a></li>
    <li><a href="view?id=<?= $model->id_pelayanan_instansi ?>"><?= $model->instansi->nama ?></a></li>
    <li class="active">Detail Jenis Pelayanan</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-header">
          <?= Html::a('Update', ['update-jenis-pelayanan', 'id' => $model->id], ['class' => 'btn btn-flat btn-primary']) ?>
          <?= Html::a('Delete', ['delete-jenis-pelayanan', 'id' => $model->id], [
              'class' => 'btn btn-flat btn-danger',
              'data' => [
                  'confirm' => 'Are you sure you want to delete this item?',
                  'method' => 'post',
              ],
          ]) ?>
          <span class=" preview-website">
              <a href="<?= Yii::$app->request->baseUrl.$urlPreview.$model->slug ?>" class="btn btn-flat btn-default" target="blank">Lihat halaman ini di website</a>
          </span>
          <div class="pull-right box-tools"><a href="view?id=<?= $model->id_pelayanan_instansi ?>" class="btn btn-sm btn-default btn-flat">Kembali</a></div>
        </div>
        <div class="box-body">
            <div class="single-page">
                <div class="judul"><?= $model->nama ?></div>
                <div class="info">Informasi terakhir diupdate pada <?= date("d M Y h:i",$model->updated_at) ?></div>
                <div class="article"><?= $model->diskripsi ?></div>
            </div>
        </div>
    </div>
</section>