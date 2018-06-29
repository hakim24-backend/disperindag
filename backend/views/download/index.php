<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DownloadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'File Download';
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
     <li class="active"><i class="fa fa-download"></i> File Download</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-body">
    
    <p>
        <?= Html::a('Tambah File', ['create'], ['class' => 'btn btn-primary btn-flat']) ?>
		<?= Html::a('Grafik Download', ['grafik'], ['class' => 'btn btn-info btn-flat']) ?>
    </p>
    <form>
    <input type="hidden" name="_backend_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />

    <?php 

        $column_action = [
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
                        $url = Yii::$app->request->baseUrl .'/'. $model->getPath().$model->nama_file;
                        return $url;
                    }
                    else if ($action === 'update') {
                        $url ='update?id='.$model->id_download;
                        return $url;
                    }
                    else if ($action === 'delete') {
                        $url ='delete?id='.$model->id_download;
                        return $url;
                    }
                }
            ]
        ];

        if(Yii::$app->user->identity->level == 'admin'){
            $column_item = [
                [
                    'class' => 'yii\grid\SerialColumn',
                    'contentOptions' => ['class' => 'td-serial-number'],
                    'headerOptions' => ['class' => 'td-serial-number']
                ],
                [
                    'attribute' => 'username',
                    'contentOptions' => ['class' => 'text-center'],
                    'headerOptions' => ['class' => 'text-center','style'=>'width:110px'],
                ],
                [
                    'attribute'=>'tgl_posting',
                    'contentOptions' => ['class' => 'text-center'],
                    'headerOptions' => ['class' => 'text-center','style'=>'width:110px'],
                ],
                [
                    'attribute' => 'kategori',
                    'value' => 'kategori.nama_kategori',
                    'headerOptions' => ['class' => 'text-center'],
                ],
                'judul',
                [
                    'attribute'=>'hits',
                    'value' => function($data){
                        return number_format($data->hits);
                    },
                    'contentOptions' => ['class' => 'text-center'],
                    'headerOptions' => ['class' => 'text-center','style'=>'width:90px'],
                ]
            ];
        }else{
            $column_item = [
                [
                    'class' => 'yii\grid\SerialColumn',
                    'contentOptions' => ['class' => 'td-serial-number'],
                    'headerOptions' => ['class' => 'td-serial-number']
                ],
                [
                    'attribute'=>'tgl_posting',
                    'contentOptions' => ['class' => 'text-center'],
                    'headerOptions' => ['class' => 'text-center','style'=>'width:110px'],
                ],
                [
                    'attribute' => 'kategori',
                    'value' => 'kategori.nama_kategori',
                    'headerOptions' => ['class' => 'text-center'],
                ],
                'judul',
                [
                    'attribute'=>'hits',
                    'value' => function($data){
                        return number_format($data->hits);
                    },
                    'contentOptions' => ['class' => 'text-center'],
                    'headerOptions' => ['class' => 'text-center','style'=>'width:90px'],
                ]
            ];
        }
        $columns = array_merge($column_item, $column_action);

    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns,
    ]); ?>
    </form>

</div>
</div>
</section>