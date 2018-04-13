<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AlbumPhotoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Album Foto';
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
     <li class="active"><i class="fa fa-photo fa-sm"></i> Album Foto</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-body">
        <p>
            <?= Html::a('Tambah Album Photo', ['create'], ['class' => 'btn btn-primary btn-flat']) ?>
        </p>

        <?php 

        if(Yii::$app->user->identity->username == "admin"){
            $columns = [
                [
                    'class' => 'yii\grid\SerialColumn',
                    'contentOptions' => ['class' => 'td-serial-number'],
                    'headerOptions' => ['class' => 'td-serial-number']
                ],

                [ 
                    'attribute'=>'user_id',
                    'contentOptions' => ['class' => 'text-center','width'=>'100px'],
                    'headerOptions' => ['class' => 'text-center']
                ],
                'jdl_album',
                [ 
                    'attribute'=>'aktif',
                    'format' => 'raw',
                    'value'=>function($data){
                        return $data->getStatus();
                    },
                    'contentOptions' => ['class' => 'text-center','width'=>'150px'],
                    'headerOptions' => ['class' => 'text-center'],
                    'filter' => Html::activeDropDownList($searchModel, 'aktif',   ['Y'=>'Aktif','N'=>'Tidak Aktif'],['class'=>'form-control','prompt' => 'Semua Status']),
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => ['class' => 'td-action'],
                ],
            ];
        }else{
            $columns = [
                [
                    'class' => 'yii\grid\SerialColumn',
                    'contentOptions' => ['class' => 'td-serial-number'],
                    'headerOptions' => ['class' => 'td-serial-number']
                ],
                'jdl_album',
                [ 
                    'attribute'=>'aktif',
                    'format' => 'raw',
                    'value'=>function($data){
                        return $data->getStatus();
                    },
                    'contentOptions' => ['class' => 'text-center','width'=>'150px'],
                    'headerOptions' => ['class' => 'text-center'],
                    'filter' => Html::activeDropDownList($searchModel, 'aktif',   ['Y'=>'Aktif','N'=>'Tidak Aktif'],['class'=>'form-control','prompt' => 'Semua Status']),
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => ['class' => 'td-action'],
                ],
            ];
        }

        ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $columns,
        ]); ?>
        </div>
    </div>
</section>