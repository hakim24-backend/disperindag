<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Unit Kerja';
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li>Manage Pegawai</li>
    <li class="active"><i class="fa fa-circle-o"></i> Unit Kerja</li>
    <li class="active"> Daftar Bidang</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        
        <div class="box-header with-border">
          <h3 class="box-title">Daftar Bidang</h3>
        </div>
        <div class="box-body">
            <p>
                <?= Html::a('Tambah Bidang', ['create'], ['class' => 'btn btn-primary btn-flat']) ?>
            </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'contentOptions' => ['class' => 'td-serial-number'],
                        'headerOptions' => ['class' => 'td-serial-number']
                    ],

                    'nama',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions' => ['class' => 'td-action'],
                        'template'=>'{view} {delete}'
                    ],
                ],
                'pager' => ['maxButtonCount' => 10],
            ]); ?>
        </div>
    </div>
</section>
