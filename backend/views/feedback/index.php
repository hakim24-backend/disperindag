<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Halaman Feedback';
// $this->title = 'Feedbacks';
// $this->params['breadcrumbs'][] = $this->title;
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'
            // 'contentOptions' => ['class' => 'td-serial-number'],
            // 'headerOptions' => ['class' => 'td-serial-number']
            ],

            // 'id',
            'tanggal',
            'nama',
            'email:email',
            'subject',
            'feedback:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
                'contentOptions' => ['class' => 'td-action'],
            ],
        ],
        // 'pager' => ['maxButtonCount' => 10],
    ]); ?>

</div>
</div>
</section>
