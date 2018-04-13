<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\TextareaAsset;

TextareaAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\Contact */

$this->title = 'Balas Pesan Buku Tamu';
?>

<section class="content-header">
  	<h1>
    	<?= $this->title ?>
    	<small></small>
  	</h1>
  	<ol class="breadcrumb">
     	<li><a href="index"><i class="fa fa-book"></i> Buku Tamu</a></li>
    	<li class="active">Balas</li>
  	</ol>
</section>

<!-- Main content -->
<section class="content">    
  <div class="box box-primary">

    <?php $form = ActiveForm::begin(); ?>
    <div class="box-header">
      <div class="pull-right box-tools"><a href="<?= Yii::$app->request->referrer ?>" class="btn btn-sm btn-default btn-flat">Kembali</a></div>
    </div><!-- /.box-header -->
    <div class="box-body">

      <?= $form->field($model, 'email')->textInput(['disabled'=>'disabled'])->label('Kepada') ?>

      <?= $form->field($model, 'subjek')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'pesan')->textarea(['rows' => 10, 'class'=>'tinymce']) ?>

    </div><!-- /.box-body -->
    <div class="box-footer">
        
          <?= Html::submitButton('<i class="fa fa-envelope-o"></i> Kirim', ['class' => 'btn btn-flat btn-primary']) ?>
        
    </div><!-- /.box-footer -->
    <?php ActiveForm::end(); ?>
  </div><!-- /. box -->
</section>