<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use miloschuman\highcharts\Highcharts;
use kartik\daterange\DateRangePicker;
use scotthuangzl\googlechart\GoogleChart;

/* @var $this yii\web\View */
/* @var $model common\models\Contact */

$this->title = "Grafik Post Berita";
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
     <li><a href="index"><i class="fa fa-book"></i> Download</a></li>
     <li class="active">Chart</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">    
	    <div class="col-md-12">
	      <div class="box-body" style="position:relative;left: 0;">

	        <?php
	        echo GoogleChart::widget(array('visualization' => 'ColumnChart',
	                'data' => array(
	                    array('Komentar', 'Polling',['role'=>'style'],['role'=>'annotation']),
	                    array('Sangat Bagus', (int)$pollSangatBagus, '#35e7ff', (int)$pollSangatBagus),
	                    array('Bagus', (int)$pollBagus, '#34b1ff', (int)$pollBagus),
	                    array('Biasa Saja', (int)$pollBiasaSaja, '#2672ff', (int)$pollBiasaSaja),
	                    array('Kurang Bagus',(int)$pollKurangBagus, '#613ff9',(int)$pollKurangBagus)
	                ),

	                'options' =>
	                  [
	                  	'legend'=>['position'=>'none'],
	                  	'width'=>'100%',
	                  	'height'=>'400',
	                  	'title'=>'Grafik Polling Survey',
	                  	'subtitle'=>'Data diambil dari total polling tiap kategori polling.',
	                  	'bar' => ['groupWidth'=>'35%']
	                  ]));
	        ?>

	      </div>
	    </div>
    </div>
</section>​