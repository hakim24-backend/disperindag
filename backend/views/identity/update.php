<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Identitas */

$this->title = 'Identitas Website';
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-database"></i> Data Master</li>
    <li class="active">Identitas Website</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="box box-primary">
		<div class="box-body">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
	    </div>
	</div>
</section>