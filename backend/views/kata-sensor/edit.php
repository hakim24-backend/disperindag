<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\KataSensor */

$this->title = 'Edit Kata Sensor';
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
     <li><i class="fa fa-database"></i> Data Master</li>
    <li><a href="index">Kata Sensor</a></li>
    <li class="active">Edit</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
    	<div class="box-header">
          <div class="pull-right box-tools"><a href="index" class="btn btn-sm btn-default btn-flat">Kembali</a></div>
        </div>
        <div class="box-body">

		    <?= $this->render('_formsingle', [
		        'model' => $model,
		    ]) ?>

		</div>
	</div>
</section>
