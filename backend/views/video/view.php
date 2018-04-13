<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\videoProfil */

$this->title = "Detail video Profil";
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
     <li><a href="index"><i class="fa fa-video-camera"></i> Video</a></li>
    <li class="active">Detail</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-header">
          <?= Html::a('Update', ['update', 'id' => $model->id_video], ['class' => 'btn btn-flat btn-primary']) ?>
          <?= Html::a('Delete', ['delete', 'id' => $model->id_video], [
              'class' => 'btn btn-flat btn-danger',
              'data' => [
                  'confirm' => 'Are you sure you want to delete this item?',
                  'method' => 'post',
              ],
          ]) ?>
          <span class=" preview-website">
              <a href="<?= $model->url ?>" class="btn btn-flat btn-default" target="blank">Lihat video ini di youtube</a>
          </span>
          <div class="pull-right box-tools"><a href="index" class="btn btn-sm btn-default btn-flat">Kembali</a></div>
        </div>
        <div class="box-body">
            <div class="single-page">
                <div class="judul"><?= $model->jdl_video ?></div>
                <div class="info">Diposting pada <?= $model->tgl_posting ?></div>
                <div class="article">
                  <div class="videoWrapper">
                  <iframe width="560" height="349" src="https://www.youtube.com/embed/<?= $model->getIdYoutubeVideo() ?>" frameborder="0" allowfullscreen></iframe>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style type="text/css">
.videoWrapper {
  position: relative;
  padding-bottom: 56.25%; /* 16:9 */
  padding-top: 25px;
  height: 0;
}
.videoWrapper iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
</style>