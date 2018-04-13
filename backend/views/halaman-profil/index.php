<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Halaman Profil';
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
     <li class="active"><i class="fa fa-flag"></i> Halaman Profil</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-body">
    <p>
        <?= Html::a('Tambah Halaman Profil', ['create'], ['class' => 'btn btn-primary btn-flat']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'contentOptions' => ['class' => 'td-serial-number'],
                'headerOptions' => ['class' => 'td-serial-number']
            ],

            'judul',

            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['class' => 'td-action'],
            ],
        ],
        'pager' => ['maxButtonCount' => 10],
    ]); ?>

</div>
</div>
</section>