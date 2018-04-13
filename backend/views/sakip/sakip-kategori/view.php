<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\SakipKategori */

$this->title = "Detail Kategori Laporan";
?>
<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
     <li><a href="index"><i class="fa fa-briefcase"></i> SAKIP</a></li>
     <li class="active">Detail Kategori Laporan</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <?= Html::a('Update', ['update-kategori', 'id' => $model->id], ['class' => 'btn btn-flat btn-primary']) ?>
            <?= Html::a('Delete', ['delete-kategori', 'id' => $model->id], [
                'class' => 'btn btn-flat btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
            <div class="pull-right box-tools"><a href="index" class="btn btn-sm btn-default btn-flat">Kembali</a></div>
        </div>
        <div class="box-body">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'nama',
                    [
                        'attribute' => 'updated_at',
                        'label' => 'Info terakhir diupdate pada',
                        'value' => date('d M Y h:i', $model->updated_at),
                    ],
                ],
            ]) ?>

        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">File Laporan <?= $model->nama ?></h3>
        </div>
        <div class="box-body">
            <p>
                <?= Html::a('Tambah File Laporan', ['create-file-laporan','id_kategori'=>$model->id], ['class' => 'btn btn-primary btn-flat']) ?>
            </p>
 
            <form>
            <input type="hidden" name="_backend_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn',
                    'contentOptions' => ['class' => 'td-serial-number'],
                    'headerOptions' => ['class' => 'td-serial-number']],

                    'nama',
                    [
                        'label'=>'Link File',
                        'format'=>'raw',
                        'value'=>function($data){
                            if($data->url != '')
                                return "<label class='label label-info'>Outside Url</label>";
                            else
                                return "<label class='label label-primary'>File Upload</label>";
                        },
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center']
                    ],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions' => ['class' => 'td-action'],
                        'buttons' => [
                                'view' => function ($url, $model) {
                                    $options = array_merge([
                                        'title' => Yii::t('yii', 'Lihat File'),
                                        'aria-label' => Yii::t('yii', 'View'),
                                        'data-pjax' => '0',
                                        'class' => 'btn btn-sm btn-info',
                                        'data-toggle' => 'tooltip',
                                        'target' => '_blank',
                                    ]);
                                return Html::a('<i class="fa fa-eye"></i>', $url, $options);
                                }
                        ],
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'view') {
                                if($model->url == ''){
                                    $url = Yii::$app->request->baseUrl."/../".Yii::$app->params['uploadUrlFile']."sakip/".$model->file;
                                }else{
                                    $url = $model->url;
                                }
                                
                                return $url;
                            }
                            else if ($action === 'update') {
                                $url ='update-file-laporan?id='.$model->id;
                                return $url;
                            }
                            else if ($action === 'delete') {
                                $url ='delete-file-laporan?id='.$model->id;
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