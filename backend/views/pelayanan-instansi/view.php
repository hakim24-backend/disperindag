<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\PelayananInstansi */

$this->title = "Detail Pelayanan Instansi";
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
     <li><a href="index"><i class="fa fa-heart-o"></i> Pelayanan</a></li>
     <li class="active"><?= $model->nama ?></li>
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

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'nama',
                'diskripsi:ntext',
                [
                 'attribute'=>'updated_at',
                 'value' => date("d M Y h:i",$model->updated_at),
                ]
            ],
        ]) ?>

        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header"><h3 class="box-title">Jenis Pelayanan <?= $model->nama; ?></h3></div>
        <div class="box-body">
            <p><?= Html::a('Tambah Jenis Pelayanan', ['create-jenis-pelayanan','id_instansi'=>$model->id], ['class' => 'btn btn-primary btn-flat']) ?></p>
            <form >
            <input type="hidden" name="_backend_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn',
                    'contentOptions' => ['class' => 'td-serial-number'],
                    'headerOptions' => ['class' => 'td-serial-number']],

                    'nama',
                    // 'created_at',
                    // 'updated_at',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions' => ['class' => 'td-action'],
                        'template' => '{view} {delete}',
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'view') {
                                $url ='view-jenis-pelayanan?id='.$model->id;
                                return $url;
                            }
                            else if ($action === 'delete') {
                                $url ='delete-jenis-pelayanan?id='.$model->id;
                                return $url;
                            }
                        }
                    ],
                ],
            ]); ?>
            </form>
        </div>
    </div>
</section>