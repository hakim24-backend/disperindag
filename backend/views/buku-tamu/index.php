<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use backend\assets\InputMaskAsset;

InputMaskAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Buku Tamu';
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
     <li class="active"><i class="fa fa-book"></i> Buku Tamu</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border"><h3 class="box-title">Print Buku Tamu</h3></div>
        <div class="box-body">
            <div class="row">
                <?php $form = ActiveForm::begin(); ?>
                <div class="col-sm-5">
                    <?= $form->field($printForm, 'start_date')->textInput(['class'=>'form-control datemaskFull','readonly'=>'true']) ?>
                </div>
                <div class="col-sm-5">
                    <?= $form->field($printForm, 'end_date')->textInput(['class'=>'form-control datemaskFull','readonly'=>'true']) ?>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <?= Html::submitButton('Print', ['class' => 'btn btn-flat btn-block btn-primary']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-body">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions'=>function($model){
                if($model->seen == 0){
                    return ['class' => 'info'];
                }
            },
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                    'contentOptions' => ['class' => 'td-serial-number'],
                    'headerOptions' => ['class' => 'td-serial-number']
                ],

                [ 
                    'attribute' => 'tanggal',
                    'contentOptions' => ['class' => 'text-center'],
                    'headerOptions' => ['class' => 'text-center']
                ],
                'email:email',
                'subjek',
                [ 
                    'attribute' => 'tampilkan',
                    'format' => 'raw',
                    'value' => function ($data){
                        return $data->showStatusTampil();
                    },
                    'contentOptions' => ['class' => 'text-center'],
                    'headerOptions' => ['class' => 'text-center']
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {delete}',
                    'contentOptions' => ['class' => 'td-action'],
                ],
            ],
        ]); ?>

        </div>
    </div>
</section>