<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'SAKIP';
?>

<section class="content-header">
  <h1>
    SAKIP
    <small></small>
  </h1>
  <ol class="breadcrumb">
     <li class="active"><i class="fa fa-briefcase"></i> SAKIP</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
    	<div class="box-header">
    		<h3 class="box-title"><?= $model->judul ?></h3>
        	<div style="color:#999;margin-bottom:5px;font-size:12px;">Info terakhir diupdate pada, <?= date("d M Y H:i",$model->updated_at) ?></div>
        	<div class="diskripsi"><?= nl2br($model->deskripsi) ?></div>
        	<div class="pull-right box-tools"><a href="update" class="btn btn-sm btn-warning btn-flat">
        		<i class="fa fa-pencil"></i> Edit Info</a></div>
    	</div>
    	<div class="box-body"></div>
    </div>
    <div class="box box-primary">
    	<div class="box-header">
    		<h3 class="box-title">Kategori Laporan</h3>
    	</div>
    	<div class="box-body">
        	<p>
		        <?= Html::a('Tambah Kategori Laporan', ['create-kategori'], ['class' => 'btn btn-primary btn-flat']) ?>
		    </p>
            <form >
            <input type="hidden" name="_backend_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
		    <?= GridView::widget([
		        'dataProvider' => $dataProvider,
		        'columns' => [
		            ['class' => 'yii\grid\SerialColumn',
                    'contentOptions' => ['class' => 'td-serial-number'],
                    'headerOptions' => ['class' => 'td-serial-number']],

		            'nama',

		            [
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions' => ['class' => 'td-action'],
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'view') {
                                $url ='view-kategori?id='.$model->id;
                                return $url;
                            }
                            else if ($action === 'update') {
                                $url ='update-kategori?id='.$model->id;
                                return $url;
                            }
                            else if ($action === 'delete') {
                                $url ='delete-kategori?id='.$model->id;
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