<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\LinkTerkait */

$this->title = "Detail Link Terkait";
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
     <li><a href="index"><i class="fa fa-link"></i> Link Terkait</a></li>
     <li class="active">Detail</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <?= Html::a('Update', ['update', 'id' => $model->id_banner], ['class' => 'btn btn-primary btn-flat']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id_banner], [
                'class' => 'btn btn-danger btn-flat',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
            <div class="pull-right box-tools"><a href="index" class="btn btn-sm btn-default btn-flat">Kembali</a></div>
        </div>
        <div class="box-body">
    

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'tgl_posting',
                    'judul',
                    [
                        'attribute' => 'url',
                        'format' => 'raw',
                        'value' => "<a href='".$model->url."' target='blank'>".$model->url."</a>",
                    ],
                    'keterangan:ntext',
                    [
                        'attribute' => 'gambar',
                        'format' => 'raw',
                        'value' => ($model->gambar != '') ? "<img width='170' class='img-thumbnail' src='".Yii::$app->request->baseUrl."/..". Yii::$app->params['uploadUrlOther'] . $model->gambar."'>" : "Tidak ada",
                    ]
                ],
            ]) ?>


        </div>
    </div>
</section>