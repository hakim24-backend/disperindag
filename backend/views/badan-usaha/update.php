<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BadanUsaha */

$this->title = 'Update Badan Usaha: ' . $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Badan Usahas', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-database"></i> Data Master</li>
    <li><a href="../index">badan-usaha</a></li>
    <li class="active">Update Baru</li>
  </ol>
</section>
<section class="content">
  	<div class="box box-primary">
    	<div class="box-header">
      		<div class="pull-right box-tools"><a href="../index" class="btn btn-sm btn-default btn-flat">Kembali</a></div>
    	</div>
    	<div class="box-body">
	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
    	</div>
    </div>
</section>