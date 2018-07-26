<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\JenisPelayananSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

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
            <p>
                <?= Html::a('Download Excel', ['export-excel'], ['class' => 'btn btn-primary btn-flat']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    // 'id',
                    //'npwp',
                    'nama_perusahaan',
                    'badan_usaha',
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
