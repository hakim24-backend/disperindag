<style type="text/css">
    #w0-cols{
        display: none;
    }
</style>
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use common\models\Villages;
use common\models\Districts;
use kartik\export\ExportMenu;


/* @var $this yii\web\View */
/* @var $searchModel common\models\JenisPelayananSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//
$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'attribute'=>'badan_usaha',
        'label'=>'Badan Usaha',
        'value'=>function($data){
            return $data->badanUsaha->nama_badan_usaha;
        },
    ],
    'nama_perusahaan',
    'nama_pemilik',
    'jalan',
    [
        'attribute'=>'kelurahan',
        'label'=>'Desa/Kel',
        'value'=>function($model){
            return $model->kelurahan != null ? Villages::find()->where(['id'=>$model->kelurahan])->one()->name : '-';
        },
    ],
    [
        'attribute'=>'kecamatan',
        'label'=>'Kecamatan',
        'value'=>function($model){
            return $model->kelurahan != null ? Villages::find()->where(['id'=>$model->kelurahan])->one()->name : '-';
        },
    ],
    'telepon',
    'fax',
    'email',
    'web',
    'tahun_izin',
    [
        'label' => 'KBLI',
        'attribute' => 'kbli',
        'value' => function($model){
            return $model->kbli != null ? $model->kbli0->nama : '-';
        }
    ],
    'komoditi',
    'jenis_produk',
    'kecamatan',
    'izin_usaha_industri',
    'cabang_industri',
    'tahun_data',
    'tk_lk',
    'tk_pr',
    'nilai_investasi',
    'jml_kapasitas_produksi',
    'satuan',
    'nilai_produksi',
    [
        'label' => 'Nilai BB/BP',
        'attribute' => 'nilai_bb_bp',
    ],
    //'nilai_bb_bp',
    'orientasi_ekspor',
    'negara_tujuan_ekspor',
    'npwp',
];

// var_dump($gridColumns);


$this->title = 'Data Perindustrian';
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-database"></i> Data Master</li>
    <li class="active">Data Perindustrian</li>
  </ol>
</section>


<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-body">

            <?= ExportMenu::widget([
                'showConfirmAlert'=>false,
                'target'=> ExportMenu::TARGET_SELF,
                'dataProvider' => $dataProvider,
                'columns' => $gridColumns,
                'fontAwesome' => true,
                // 'asDropdown' => false,
                'dropdownOptions' => [
                    'label' => 'Export All',
                    'class' => 'btn btn-default'
                ],
                'exportConfig' => [
                    ExportMenu::FORMAT_HTML => false,
                    ExportMenu::FORMAT_TEXT => false,
                    ExportMenu::FORMAT_PDF => false
                ]
            ]). "<hr>\n".
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    // 'id',
                    //'npwp',
                    'nama_perusahaan',
                    [
                        'attribute'=>'badan_usaha',
                        'label'=>'Badan Usaha',
                        'format'=>'raw',
                        'value'=>function($data){
                            return $data->badanUsaha->nama_badan_usaha;
                        },
                        'contentOptions' => ['class' => 'td-action'],
                        'headerOptions' => ['class' => 'text-center'],
                    ],
                    'nama_pemilik',
                    [
                        'attribute'=>'status',
                        'label'=>'Status Aktif',
                        'format'=>'raw',
                        'value'=>function($data){
                            return ($data->status==1) ? "<span class='label label-success'>Aktif</span>" : "<span class='label label-danger'>Non-Aktif</span>";
                        },
                        'contentOptions' => ['class' => 'td-action'],
                        'headerOptions' => ['class' => 'text-center'],
                        'filter' => Html::activeDropDownList($searchModel, 'status', [1=>'Aktif',0=>'Non-Aktif'],['class'=>'form-control','prompt' => 'Semua Status']),
                    ],
                    // 'jalan',
                    //'kelurahan',
                    //'kecamatan',
                    //'telepon',
                    //'fax',
                    //'email:email',
                    //'web',
                    //'izin_usaha_industri',
                    //'tahun_izin',
                    //'kbli',
                    //'komoditi',
                    //'jenis_produk',
                    //'cabang_industri',
                    //'tahun_data',
                    //'tk_lk',
                    //'tk_pr',
                    //'nilai_investasi',
                    //'jml_kapasitas_produksi',
                    //'satuan',
                    //'nilai_produksi',
                    //'nilai_bb_bp',
                    //'orientasi_ekspor',
                    //'negara_tujuan_ekspor',
                    //'status',
                    // ['class' => 'yii\grid\ActionColumn'],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template'=>'{view}',
                        'contentOptions' => ['class' => 'td-action'],
                    ],
                ],
            ]); ?>

        </div>
    </div>
</section>
