<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Akun Email';
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li>Manage Pegawai</li>
    <li class="active"><i class="fa fa-user"></i> Akun Email</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <!-- <p>
                <?= Html::a('Tambah Akun Email', ['create'], ['class' => 'btn btn-primary btn-flat']) ?>
            </p> -->

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'rowOptions'=>function($model){
                    if($profile = $model->getProfile()){
                        if($profile->seen == 0){
                            return ['class' => 'info'];
                        }
                    }
                },
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'contentOptions' => ['class' => 'td-serial-number'],
                        'headerOptions' => ['class' => 'td-serial-number']
                    ],

                    //'accountid',
                    //'accountdomainid',
                    //'accountadminlevel',
                    [
                        'attribute'=>'accountaddress',
                        'label'=>'Email',
                    ],
                    //'accountpassword',
                    [
                        'attribute'=>'accountactive',
                        'label'=>'Status Aktif',
                        'format'=>'raw',
                        'value'=>function($data){
                            return ($data->accountactive==1) ? "<span class='label label-success'>Aktif</span>" : "<span class='label label-danger'>Non-Aktif</span>";
                        },
                        'contentOptions' => ['class' => 'td-action'],
                        'headerOptions' => ['class' => 'text-center'],
                        'filter' => Html::activeDropDownList($searchModel, 'accountactive',   ['1'=>'Aktif','0'=>'Non-Aktif'],['class'=>'form-control','prompt' => 'Semua Status']),
                    ],
                    [
                        'label' => 'created_at',
                        'format' => 'raw',
                        'value' => function($data){
                            return ($profile = $data->getProfile()) ? date('H:s | d M Y',$profile->created_at) : "-";
                        },
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center']
                    ],
                    // 'accountisad',
                    // 'accountaddomain',
                    // 'accountadusername',
                    // 'accountmaxsize',
                    // 'accountvacationmessageon',
                    // 'accountvacationmessage:ntext',
                    // 'accountvacationsubject',
                    // 'accountpwencryption',
                    // 'accountforwardenabled',
                    // 'accountforwardaddress',
                    // 'accountforwardkeeporiginal',
                    // 'accountenablesignature',
                    // 'accountsignatureplaintext:ntext',
                    // 'accountsignaturehtml:ntext',
                    // 'accountlastlogontime',
                    // 'accountvacationexpires',
                    // 'accountvacationexpiredate',
                    // 'accountpersonfirstname',
                    // 'accountpersonlastname',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions' => ['class' => 'td-action'],
                        'template'=>'{view} {delete}',
                    ],
                ],
            ]); ?>

        </div>
    </div>
</section>