<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Contact */

$this->title = "Detail Buku Tamu";
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
     <li><a href="index"><i class="fa fa-book"></i> Buku Tamu</a></li>
     <li class="active">Detail</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-header">
        
            <?= Html::a('Update', ['update', 'id' => $model->id_hubungi], ['class' => 'btn btn-flat btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id_hubungi], [
                'class' => 'btn btn-danger btn-flat',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
            
            <span class=" preview-website">
                <?= Html::a('Balas', ['compose-email', 'id' => $model->id_hubungi], ['class' => 'btn btn-flat btn-warning']) ?>
            </span>

            <div class="pull-right box-tools"><a href="index" class="btn btn-sm btn-default btn-flat">Kembali</a></div>
        </div>
        <div class="box-body">

            <?php $form = ActiveForm::begin(['options'=>['class'=>'']]); ?>
            <div class="row">
                <div class="col-md-10 col-sm-8"><?= $form->field($model, 'tampilkan')->dropDownList([ 'Y' => 'Ditampilkan', 'N' => 'Tidak Ditampilkan', ], ['prompt' => 'Pilih status tampil'])->label('Status Tampil') ?></div>
                <div class="col-md-2 col-sm-4">
                    <div class="form-group">
                        <label>&nbsp;</label><br>
                        <?= Html::submitButton('Update Status', ['class' => 'btn btn-block btn-flat btn-primary']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'tanggal',
                    'nama',
                    'email:email',
                    'subjek',
                    'pesan:ntext',
                    [
                        'attribute'=>'tampilkan',
                        'format' => 'raw',
                        'value' => $model->showStatusTampil(),
                    ]
                ],
            ]) ?>
        </div>
    </div>

    <?php if(!empty($balasan)){ ?>
    <div class="box box-primary balasan-buku-tamu">
        <div class="box-header with-border">
            <h3 class="box-title">Anda Telah Membalas Pesan Ini</h3>
        </div>
        <div class="box-body">
            <?php 
                foreach ($balasan as $key => $item) {
                    echo '<div class="item">
                            <div class="subjek">'.$item->subjek.'</div>
                            <div class="date">'.date("d M Y | H:i", $item->created_at).'</div>
                            <div class="pesan">'.$item->pesan.'</div>
                        </div>';
                }
            ?>
        </div>
    </div>
    <?php } ?>
</section>

<style type="text/css">
    .item{
        border:dotted 1px #ddd;
        padding: 15px;
        margin-bottom: 10px;
    }
    .item .subjek{
        font-weight: bold;
        font-size: 16px;
    }
    .item .date{
        font-size: 12px;
        color: #999;
    }
    .item .pesan{
        margin-top: 5px;
    }
    .balasan-buku-tamu p{
        margin:0px;
    }
</style>