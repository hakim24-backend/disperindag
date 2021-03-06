<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kategori Posts';
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
     <li><i class="fa fa-database"></i> Data Master</li>
    <li class="active">Kategori Post</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a('Tambah Kategori Post', ['create'], ['class' => 'btn btn-primary btn-flat']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn',
                    'contentOptions' => ['class' => 'td-serial-number'],
                    'headerOptions' => ['class' => 'td-serial-number']],

                    'nama_kategori',
                    //'aktif',

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
