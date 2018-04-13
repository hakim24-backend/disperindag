<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\assets\ShowImageAsset;

ShowImageAsset::register($this);
/* @var $this yii\web\View */
/* @var $model common\models\AlbumPhoto */

$this->title = "Detail Album Foto";
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="index"><i class="fa fa-photo fa-sm"></i> Album Foto</a></li>
    <li class="active">Detail</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <?= Html::a('Update', ['update', 'id' => $model->id_album], ['class' => 'btn btn-flat btn-primary']) ?>
                <?= Html::a('Hapus', ['delete', 'id' => $model->id_album], [
                    'class' => 'btn btn-flat btn-danger',
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
                    'jdl_album',
                    [
                        'attribute'=>'aktif',
                        'format'=>'raw',
                        'value' => $model->getStatus(),
                    ]
                ],
            ]) ?>

        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Foto pada album <?= $model->jdl_album ?></h3>
        </div>
        <div class="box-body">
            <p>
                <?= Html::a('Tambah Foto', ['create-photo','id_album'=>$model->id_album], ['class' => 'btn btn-primary btn-flat']) ?>
            </p>

            <div class="row list-photo">
                <?php 
                if(count($photos) > 0){
                    foreach ($photos as $key => $photo) { ?>
                    <div class="col-md-2 col-sm-3 col-xs-6 item">
                        <div class="image img-thumbnail">
                            <img src="<?= Yii::$app->request->baseUrl."/".$photo->getPath('thumb').$photo->gbr_gallery ?>">
                        </div>
                        <div class="action">
                            
                            <a href="<?= Yii::$app->request->baseUrl.'/'.$photo->getPath('show').$photo->gbr_gallery ?>" data-lightbox="example-set" data-title="<?= $photo->jdl_gallery ?>" class="btn btn-sm btn-flat btn-info"><i class="fa fa-sm fa-eye"></i></a>
                            <?= Html::a('<i class="fa fa-sm fa-edit"></i>', ['update-photo', 'id' => $photo->id_gallery], ['class' => 'btn btn-sm btn-flat btn-primary']) ?>
                            <?= Html::a('<i class="fa fa-sm fa-trash"></i>', ['delete-photo', 'id' => $photo->id_gallery], [
                                'class' => 'btn btn-sm btn-flat btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </div>
                    </div>
                <?php }
                } else{
                    echo "<div class='col-sm-12 empty'>Belum ada foto pada album ini</div>";
                } ?>
            </div>
        </div>
    </div>
</section>

<style type="text/css">
    .list-photo{    
        margin-top: 20px;
    }
    .list-photo .item{
        margin-bottom: 25px;
    }
    .list-photo .item .image{
        overflow: hidden;
        height: 100px;
    }
    .list-photo .item .image img{
        width: 100%;
    }
    .list-photo .item .action{
        text-align: center;
    }
    .list-photo .item .action a{
        
    }
    .empty{
        color:#999;
        font-style: italic;
    }
</style>