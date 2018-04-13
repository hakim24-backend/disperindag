<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MemberMobile */

$this->title = "Detail Akun Email";
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li>Manage Pegawai</li>
    <li><a href="index"><i class="fa fa-user"></i> Akun Email</a></li>
    <li class="active">Detail</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <p>
                <!--<?= Html::a('Update', ['update', 'id' => $model->accountid], ['class' => 'btn btn-primary btn-flat']) ?>-->
                <?= Html::a('Delete', ['delete', 'id' => $model->accountid], [
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
                <div class="col-md-10 col-sm-8"><?= $form->field($model, 'accountactive')->dropDownList([ '1' => 'Aktif', '0' => 'Non-Aktif', ], ['prompt' => 'Pilih status'])->label('Update Status Akun Email') ?></div>
                <div class="col-md-2 col-sm-4">
                    <div class="form-group">
                        <label>&nbsp;</label><br>
                        <?= Html::submitButton('Update Status', [
                            'class' => 'btn btn-block btn-flat btn-primary',
                            'data' => [
                                'confirm' => 'Apakah Anda yakin ingin ingin mengganti status akun email ini?',
                            ],
                        ]) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    //'accountid',
                    //'accountdomainid',
                    //'accountadminlevel',
                    'accountaddress',
                    //'accountpassword',
                    [
                        'attribute'=>'accountactive',
                        'format'=>'raw',
                        'value' => $model->getStatus(),
                    ],
                    [
                        'label'=>'NIP',
                        'value'=>($modelProfile) ? $modelProfile->nip : '-',
                    ],
                    [
                        'label'=>'Nama',
                        'value'=>($modelProfile) ? $modelProfile->name : '-',
                    ],
                    [
                        'label'=>'Bidang',
                        'value'=>($modelProfile) ? $modelProfile->bidang->nama : '-',
                    ],
                    [
                        'label'=>'Subbag',
                        'value'=>($modelProfile) ? $modelProfile->subbag->nama : '-',
                    ],
                    [
                        'label'=>'Email Alternatif',
                        'value'=>($modelProfile) ? $modelProfile->email_alternatif : '-',
                    ],
                    [
                        'label'=>'Nomor HP',
                        'value'=>($modelProfile) ? $modelProfile->phone_number : '-',
                    ],
                    [
                        'label'=>'Jenis Kelamin',
                        'value'=>($modelProfile) ? ($modelProfile->gender==1) ? 'Laki-laki' : 'Perempuan' : '-',
                    ],
                    [
                        'label'=>'Tanggal Lahir',
                        'value'=>($modelProfile) ? $modelProfile->birthday : '-',
                    ],
                    [
                        'label'=>'Tanggal Masuk Pegawai',
                        'value'=>($modelProfile) ? $modelProfile->in_time_agencies : '-',
                    ],
                    // [
                    //     'label'=>'Alamat',
                    //     'value'=>($modelProfile) ? $modelProfile->address : '-',
                    // ],
                    'accountlastlogontime',
                ],
            ]) ?>

</div>
</div>
</section>