<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use miloschuman\highcharts\Highcharts;
use kartik\daterange\DateRangePicker;
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
							
							  'title' => ['text' => 'Grafik Post Berita'],
							  'xAxis' => [
								 'categories' => $dataX
							  ],
							  'yAxis' => [
								 'title' => ['text' => 'Jumlah Post Berita Sering Dibaca']
							  ],
							  'series' => [	
								['type'=>'bar', 'name' => 'Post Berita', 'data' => $dataY], 
							  ]
								 
							  
						   ]
						]);
			?>

        </div>
    </div>
</section>
  