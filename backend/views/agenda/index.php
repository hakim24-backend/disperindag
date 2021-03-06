<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AgendaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Agenda';
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
     <li class="active"><i class="fa fa-calendar-o"></i> Agenda</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-body">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Agenda', ['create'], ['class' => 'btn btn-primary btn-flat']) ?>
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
                'tema',
                'tempat',
                'tgl_mulai',

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

                
                'tema',
                'tempat',
                'tgl_mulai',

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