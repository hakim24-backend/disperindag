<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use miloschuman\highcharts\Highcharts;
use kartik\daterange\DateRangePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Contact */

$this->title = "Grafik Buku Tamu";
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
     <li><a href="index"><i class="fa fa-book"></i> Buku Tamu</a></li>
     <li class="active">Grafik</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
<div class="box box-primary">
        <div class="box-header with-border"><h3 class="box-title">Filter Grafik Buku Tamu</h3></div>
        <div class="box-body">
            <div class="row">
               <?php $form = ActiveForm::begin(); ?>
                <div class="col-sm-10">
                   <?php
							$addon = <<< HTML
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-calendar"></i>
										</span> 
HTML;
							echo '<div class="input-group drp-container">';
							echo DateRangePicker::widget([
								'name'=>'kvdate3',
								
								'useWithAddon'=>true,
								'convertFormat'=>true,
								'startAttribute' => 'from_date',
								'endAttribute' => 'to_date',
								'pluginOptions'=>[
									'locale'=>['format' => 'Y-m-d'],
									'optoins'=>[
									'required'=>true,
								]
									
								],
								
							]) . $addon;
							echo '</div>';						
						?>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <?= Html::submitButton('Filter', ['class' => 'btn btn-flat btn-block btn-primary']) ?>
                    </div>
                </div>
               <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        
        <div class="box-body">
			
			<?php
				echo Highcharts::widget([
						   'options' => [
							
							  'title' => ['text' => 'Grafik Buku Tamu'],
							  'xAxis' => [
								 'categories' => $dataX
							  ],
							  'yAxis' => [
								 'title' => ['text' => 'Jumlah Tamu']
							  ],
							  'series' => [	
								 ['name' => 'Tamu', 'data' => $dataY],
								 
							  ]
						   ]
						]);
			?>

        </div>
    </div>
</section>
  