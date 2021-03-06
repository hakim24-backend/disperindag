<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use backend\assets\InputMaskAsset;
use yii\widgets\Pjax;
use yii\web\Session;

InputMaskAsset::register($this);


/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$session = Yii::$app->session;
$selected = array();
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
                <div class="col-sm-1">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <?= Html::submitButton('Print', ['class' => 'btn btn-flat btn-block btn-primary']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

    <!-- <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="box-header with-border"><h3 class="box-title">Print Buku Tamu</h3></div>
                    <div class="col-sm-4">
                        <label class="">Dari Tanggal</label>
                        <input type="text" id="start_date" class="form-control datemaskFull" name="PrintBukuTamuForm[start_date]" readonly="true" aria-required="true" aria-invalid="true">
                    </div>
                    <div class="col-sm-4">
                        <label>Sampai Tanggal</label>
                        <input type="text" id="end_date" class="form-control datemaskFull" name="PrintBukuTamuForm[end_date]" readonly="true" aria-required="true" aria-invalid="true">
                    </div>
                    <div class="col-sm-2">
                        <label> &nbsp; </label><br>
                        <a class="btn btn-primary excel">Print Excel</a>
                    </div>
                    <div class="col-sm-2">
                        <label> &nbsp; </label><br>
                        <a class="btn btn-warning pdf">Print PDF</a>
                    </div>
            </div>
        </div>
    </div> -->

    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-sm-2">
                    <?= Html::a('Grafik Buku Tamu', ['grafik'], ['class' => 'btn btn-success']) ?>
                </div>
                <div class="col-sm-2">
                    <?php $form = ActiveForm::begin(
                                    [   'action' =>['buku-tamu/delete-all'],
                                        'method' => 'post',
                                     ]
                                    ); ?>
                    <?php Pjax::begin(); ?>
                    <?= Html::submitButton('Hapus', [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>
            </div>
        <br>
        <p>
        </p>
        <hr>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <br>

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
                   'class' => 'yii\grid\CheckboxColumn',
                   'header' => '',
                   'checkboxOptions' => function($model) {
                        return [
                            'value' => $model->id_hubungi,
                            // 'checked' => true,
                            'class'=>'del-selected',
                            'id'=> $model->id_hubungi
                        ];
                    },
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {delete}',
                    'contentOptions' => ['class' => 'td-action'],
                ],
            ],
        ]); ?>


        <?php Pjax::end(); ?>
        <?php ActiveForm::end(); ?>


        </div>
    </div>
</section>

<!-- <script type="text/javascript">
    $(".excel").on("click",function(){
        var date1 = $("#start_date").val();
        var date2 = $("#end_date").val();
        $.ajax({
            url : "<?php echo Url::to(['buku-tamu/excel']) ?>",
            data : {
                date1 : $("#start_date").val(),
                date2 : $("#end_date").val()
            }
        }).done(function(data){
            window.location.replace("../buku-tamu/excel?date1="+date1+"&date2="+date2+"");
        });
    });

    $(".pdf").on("click",function(){
        var date1 = $("#start_date").val();
        var date2 = $("#end_date").val();
        $.ajax({
            url : "<?php echo Url::to(['buku-tamu/pdf']) ?>",
            data : {
                date1 : $("#start_date").val(),
                date2 : $("#end_date").val()
            }
        }).done(function(data){
            window.open("../buku-tamu/pdf?date1="+date1+"&date2="+date2+"");
        })
    });
</script> -->
