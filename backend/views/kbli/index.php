<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KbliSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kbli';
?>
<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
     <li><i class="fa fa-database"></i> Data Master</li>
    <li class="active">Kbli</li>
  </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-body">
        <p>
            <?= Html::a('Create Kbli', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                'kode',
                'nama',

                [
                    'class' => 'yii\grid\ActionColumn',
                    // 'template'=>'{update} {view} {delete}',
                    // 'contentOptions' => ['class' => 'td-action']
                ],
            ],
        ]); ?>
        </div>
    </div>
</section>