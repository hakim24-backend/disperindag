<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'List Post Berita';
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
     <li class="active"><i class="fa fa-bullhorn"></i> Post</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Tambah Post Berita', ['create'], ['class' => 'btn btn-primary btn-flat']) ?>
				<?= Html::a('Grafik Post Berita', ['grafik'], ['class' => 'btn btn-info btn-flat']) ?>
			</p>

            <?php 
            if(Yii::$app->user->identity->level=="admin"){ 
                $columns = [
                    ['class' => 'yii\grid\SerialColumn',
                    'contentOptions' => ['class' => 'td-serial-number'],
                    'headerOptions' => ['class' => 'td-serial-number']],
                    [
                        'attribute' => 'username',
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center','style'=>'width:110px'],
                    ],
                    [
                        'attribute' => 'tanggal',
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center','style'=>'width:110px'],
                    ],
                    [
                        'attribute' => 'kategoriPost',
                        'value' => 'kategoriPost.nama_kategori',
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center','style'=>'width:150px'],
                    ],
                    'judul',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions' => ['class' => 'td-action'],
                    ],
                ];
            }else{ 
                $columns = [
                    ['class' => 'yii\grid\SerialColumn',
                    'contentOptions' => ['class' => 'td-serial-number'],
                    'headerOptions' => ['class' => 'td-serial-number']],
                    [
                        'attribute' => 'tanggal',
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center','style'=>'width:110px'],
                    ],
                    [
                        'attribute' => 'kategoriPost',
                        'value' => 'kategoriPost.nama_kategori',
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center','style'=>'width:150px'],
                    ],
                    'judul',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions' => ['class' => 'td-action'],
                    ],
                ];
            } ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => $columns,
                'pager' => ['maxButtonCount' => 10],
            ]); ?>

        </div>
    </div>
</section>