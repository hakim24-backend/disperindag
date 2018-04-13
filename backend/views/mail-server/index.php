<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mail Server Setting';
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li class="active"><i class="fa fa-server"></i> Mail Server Setting</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <iframe src="<?= Yii::$app->params['urlMailServerSetting'] ?>" width="100%" height="800px"></iframe>
        </div>
    </div>
</section>