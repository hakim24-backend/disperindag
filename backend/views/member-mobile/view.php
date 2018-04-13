<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MemberMobile */

$this->title = "Detail Member";
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
     <li><a href="index"><i class="fa fa-user"></i> Member Mobile</a></li>
     <li class="active">Detail</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-flat']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger btn-flat',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
            <div class="pull-right box-tools"><a href="index" class="btn btn-sm btn-default btn-flat">Kembali</a></div>
        </div>
        <div class="box-body">

            <?php $form = ActiveForm::begin(['options'=>['class'=>'']]); ?>
            <div class="row">
                <div class="col-md-10 col-sm-8"><?= $form->field($model, 'status')->dropDownList([ '10' => 'Aktif', '0' => 'Non-Aktif', ], ['prompt' => 'Pilih status'])->label('Update Status Member') ?></div>
                <div class="col-md-2 col-sm-4">
                    <div class="form-group">
                        <label>&nbsp;</label><br>
                        <?= Html::submitButton('Update Status', [
                            'class' => 'btn btn-block btn-flat btn-primary',
                            'data' => [
                                'confirm' => 'Apakah Anda yakin ingin ingin mengganti status member ini?',
                            ],
                        ]) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            'nama',
            'email:email',
            'instansi',
            'alamat',
            'no_telp',
            [
                'attribute'=>'status',
                'format'=>'raw',
                'value' => $model->getStatus(),
            ],
            [
                'attribute'=>'created_at',
                'value' => $model->getDate($model->created_at),
            ]
        ],
    ]) ?>

</div>
</div>
</section>