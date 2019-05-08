<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use common\models\Villages;
use common\models\Districts;
use common\models\Regencies;

/* @var $this yii\web\View */
/* @var $model common\models\Industri */
// var_dump($model->kbli0->nama);die();
// $dataKelurahan=;
// $dataKecamatan=
// var_dump();die();
$this->title = "Detail Data Perindustrian";
?>
<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
</h1>
<ol class="breadcrumb">
    <li>Manage Data Industri</li>
    <li><a href="index"><i class="fa fa-user"></i> Data Perindustrian</a></li>
    <li class="active">Detail</li>
</ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <div class="pull-right box-tools"><a href="index" class="btn btn-sm btn-default btn-flat">Kembali</a></div>
        </div>
        <div class="box-body">
            <?php $form = ActiveForm::begin(['action' => 'update/'.$model->id]); ?>
            <div class="row">
                <div class="col-md-10 col-sm-8"><?= $form->field($model, 'status')->dropDownList([ 1 => 'approve', 0 => 'pending', ], ['prompt' => 'Pilih status'])->label('Update Data Industri') ?></div>
                <div class="col-md-2 col-sm-4">
                    <div class="form-group">
                        <label>&nbsp;</label><br>
                        <?= Html::submitButton('Update Status', ['class' => 'btn btn-block btn-flat btn-primary']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    // 'jalan',
                    [
                        'attribute'=>'status',
                        'format'=>'raw',
                        'value' => $model->getStatus(),
                    ],
                    [
                        'attribute' => 'badanUsaha.nama_badan_usaha',
                        'value' => $model->badan_usaha != null ? $model->badanUsaha->nama_badan_usaha : '-',
                    ],
                    [
                        'attribute' => 'nama_perusahaan',
                        'value' => $model->nama_perusahaan != null ? $model->nama_perusahaan : '-',
                    ],
                    [
                        'attribute' => 'nama_pemilik',
                        'value' => $model->nama_pemilik != null ? $model->nama_pemilik : '-',
                    ],
                    [
                        'label' => 'Alamat',
                        'attribute'=>'jalan',
                        'value' => $model->jalan != null ? $model->jalan : '-',
                    ],
                    [
                        'attribute' => 'kabupaten',
                        'value' => $model->kabupaten != null ? Regencies::find()->where(['id'=>$model->kabupaten])->one()->name : '-',
                    ],
                    [
                        'attribute' => 'kelurahan',
                        'value' => $model->kelurahan != null ? Villages::find()->where(['id'=>$model->kelurahan])->one()->name : '-',
                    ],
                    [
                        'attribute' => 'kecamatan',
                        'value' => $model->kecamatan != null ? Districts::find()->where(['id'=>$model->kecamatan])->one()->name : '-',
                    ],
                    [
                        'label' => 'No. telp',
                        'attribute'=>'telepon',
                        'value' => $model->telepon != null ? $model->telepon : '-',

                    ],
                    [
                        'attribute' => 'fax',
                        'value' => $model->fax != null ? $model->fax : '-',
                    ],
                    [
                        'attribute' => 'email',
                        'value' => $model->email != null ? $model->email : '-',
                    ],
                    [
                        'attribute' => 'web',
                        'value' => $model->web != null ? $model->web : '-',
                    ],
                    [
                        'attribute' => 'izin_usaha_industri',
                        'value' => function($model) {
                            if (is_numeric($model->izin_usaha_industri)) {
                                if($model->izin_usaha_industri != NULL){
                                    if ($model->izin_usaha_industri==0) {
                                        return 'belum';
                                    }else if ($model->izin_usaha_industri==1) {
                                        return 'TDI';
                                    }else if ($model->izin_usaha_industri==2) {
                                        return 'IUI';
                                    }else if ($model->izin_usaha_industri==3) {
                                        return 'IUMK';
                                    }else if ($model->izin_usaha_industri==4) {
                                        return 'IZIN LAINNYA';
                                    }
                                }else{

                                    return '-';
                                }
                            } else {
                                return $model->izin_usaha_industri;
                            }
                        },
                    ],
                    [
                        'attribute' => 'tahun_izin',
                        'value' => $model->tahun_izin != null ? $model->tahun_izin : '-',
                    ],
                    [
                        'label' => 'Nama KBLI',
                        'attribute' => 'kbli0.nama',
                        'value' => $model->kbli != null ? $model->kbli0->kode."-".$model->kbli0->nama : '-',
                    ],
                    [
                        'attribute' => 'komoditi',
                        'value' => $model->komoditi != null ? $model->komoditi : '-',
                    ],
                    [
                        'attribute' => 'jenis_produk',
                        'value' => $model->jenis_produk != null ? $model->jenis_produk : '-',
                    ],
                    [
                        'attribute' => 'cabang_industri',
                        'value' => $model->cabang_industri != null ? $model->cabang_industri : '-',
                    ],
                    [
                        'label' => 'TK LK',
                        'attribute' => 'tk_lk',
                        'value' => $model->tk_lk != null ? $model->tk_lk : '-',
                    ],
                    [
                        'label' => 'TK PR',
                        'attribute' => 'tk_pr',
                        'value' => $model->tk_pr != null ? $model->tk_pr : '-',
                    ],
                    [
                        'attribute' => 'nilai_investasi',
                        'value' => $model->nilai_investasi != null ? $model->nilai_investasi : '-',
                    ],
                    [
                        'attribute' => 'jml_kapasitas_produksi',
                        'value' => $model->jml_kapasitas_produksi != null ? $model->jml_kapasitas_produksi : '-',
                    ],
                    [
                        'attribute' => 'satuan',
                        'value' => $model->satuan != null ? $model->satuan : '-',
                    ],
                    [
                        'attribute' => 'nilai_produksi',
                        'value' => $model->nilai_produksi != null ? $model->nilai_produksi : '-',
                    ],
                    [
                        'attribute' => 'nilai_bb_bp',
                        'value' => $model->nilai_bb_bp != null ? $model->nilai_bb_bp : '-',
                    ],
                    [
                        'attribute' => 'orientasi_ekspor',
                        'value' => $model->orientasi_ekspor != null ? $model->orientasi_ekspor : '-',
                    ],
                    [
                        'attribute' => 'negara_tujuan_ekspor',
                        'value' => $model->negara_tujuan_ekspor != null ? $model->negara_tujuan_ekspor : '-',
                    ],
                    [
                        'attribute' => 'npwp',
                        'value' => $model->npwp != null ? $model->npwp : '-',
                    ],
                ],
            ]) ?>
            <div class="pull-right box-tools">
                <p>
                    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger btn-flat',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
            </div>
        </div>
    </div>
</section>