<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UptIndagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'UPT INDAG';
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
     <li><i class="fa fa-heart-o"></i> Pelayanan</li>
     <li class="active">UPT INDAG</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a('Tambah UPT INDAG', ['create'], ['class' => 'btn btn-flat btn-primary']) ?>
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

                    'judul',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions' => ['class' => 'td-action'],
                    ],
                ],
            ]); ?>

        </div>
    </div>
</section>