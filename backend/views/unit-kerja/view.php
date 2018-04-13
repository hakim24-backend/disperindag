<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Contact */

$this->title = "Bidang ".$model->nama;
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
    <li class="active"><?= $model->nama ?></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <div class="pull-right box-tools"><a href="index" class="btn btn-sm btn-default btn-flat">Kembali</a></div>
        </div>
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

    
    <div class="box box-primary balasan-buku-tamu">
        <div class="box-header with-border">
            <h3 class="box-title">Daftar Subbag Bidang <?= $model->nama ?></h3>
        </div>
        <div class="box-body">
            <p>
                <?= Html::a('Tambah Subbag', ['create-subbag','id_bidang'=>$model->id], ['class' => 'btn btn-primary btn-flat']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn',
                    'contentOptions' => ['class' => 'td-serial-number'],
                    'headerOptions' => ['class' => 'td-serial-number']],

                    'nama',

                    ['class' => 'yii\grid\ActionColumn',
                    'template'=>'{update} {delete}',
                    'contentOptions' => ['class' => 'td-action']],
                ],
            ]); ?>
        </div>
    </div>
    
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