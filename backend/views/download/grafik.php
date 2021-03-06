<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use miloschuman\highcharts\Highcharts;
use kartik\daterange\DateRangePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Contact */

$this->title = "Grafik Download";
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
     <li><a href="index"><i class="fa fa-book"></i> Download</a></li>
     <li class="active">Grafik</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        
        <div class="box-body">
			
			<?php
				echo Highcharts::widget([
						   'options' => [
							
							  'title' => ['text' => 'Grafik Dowload'],
							  'xAxis' => [
								 'categories' => $dataX
							  ],
							  'yAxis' => [
								 'title' => ['text' => 'Jumlah Download']
							  ],
							  'series' => [	
								 ['type'=>'bar', 'name' => 'Download', 'data' => $dataY],
								 
							  ]
						   ]
						]);
			?>

        </div>
    </div>
</section>
  