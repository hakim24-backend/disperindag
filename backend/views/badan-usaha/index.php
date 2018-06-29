<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BadanUsahaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Badan Usaha';
// $this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
     <li><i class="fa fa-database"></i> Data Master</li>
    <li class="active">Badan Usaha</li>
  </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-body">
        <p>
            <?= Html::a('Tambah Badan Usaha', ['create'], ['class' => 'btn btn-primary btn-flat']) ?>
        </p>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                'nama_badan_usaha',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template'=>'{update} {delete}',
                    'contentOptions' => ['class' => 'td-action']
                ],
            ],
        ]); ?>
        </div>
    </div>
</section>
