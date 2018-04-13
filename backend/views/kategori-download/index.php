<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kategori Download';
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
     <li><i class="fa fa-database"></i> Data Master</li>
    <li class="active">Kategori Download</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a('Tambah Kategori Download', ['create'], ['class' => 'btn btn-primary btn-flat']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn',
                    'contentOptions' => ['class' => 'td-serial-number'],
                    'headerOptions' => ['class' => 'td-serial-number']],

                    'nama_kategori',
                    [
						'attribute'=>'aktif',
						'format'=>'raw',
						'value'=>function($data){
							if($data->aktif=='Y')
								return "<label class='label label-success'>Aktif</label>";
							else
								return "<label class='label label-danger'>Tidak Aktif</label>";
						},
						'contentOptions' => ['class' => 'text-center'],
						'headerOptions' => ['class' => 'text-center'],
					],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template'=>'{update} {delete}',
                        'contentOptions' => ['class' => 'td-action'],
                    ],
                ],
            ]); ?>

        </div>
    </div>
</section>
