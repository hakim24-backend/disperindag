<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MemberMobileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Member Mobiles';
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
     <li class="active"><i class="fa fa-user"></i> Member Mobile</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-body">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Member Mobile', ['create'], ['class' => 'btn btn-primary btn-flat']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=>function($model){
            if($model->seen == 0){
                return ['class' => 'info'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
                    'contentOptions' => ['class' => 'td-serial-number'],
                    'headerOptions' => ['class' => 'td-serial-number']],

            //'id',
			
            'nama',
			
            //'gender',
            //'alamat',
            //'no_telp',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            [
                'attribute' => 'created_at',
                'format' => 'raw',
				'filter' => DateRangePicker::widget([
											'name' => 'MemberMobileSearch[created_at]',
											'convertFormat'=>true,
											'startAttribute' => 'from_date',
											'endAttribute' => 'to_date',
											'pluginOptions'=>[
												'locale'=>['format' => 'Y-m-d'],
												
												
											],
										]),
                'value' => function($data){
                    return $data->getDate($data->created_at);
                },
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center']
            ],
			[
                'attribute'=>'status',
                'format'=>'raw',
                'value' => function($data){
                    return $data->getStatus();
                },
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                 'filter' => Html::activeDropDownList($searchModel, 'status',   ['10'=>'Aktif','00'=>'Non-Aktif'],['class'=>'form-control','prompt' => 'Semua Status']),
            ],
            
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['class' => 'td-action'],
            ],
        ],
    ]); ?>

        </div>
    </div>
</section>