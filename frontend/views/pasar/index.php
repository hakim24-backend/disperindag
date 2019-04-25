<?php
use yii\helpers\Html; 
$this->title = "Harga Pasar";

?>
                   
<div class="single-page">
	<div class="top">
		<div class="title">Informasi Harga Pasar</div>
		<div class="td-post-meta">
			
        </div>               
	</div>

	<div class="row">
		<div class="filter-pasar">
			<!-- Single button -->
			<div class="btn-group">
				<?php echo Html::dropDownList('kabupaten', '', $kabupaten, ['prompt' => 'Pilih Kota/Kabupaten','class'=>'kabupaten']); ?>
			</div>
		</div>
	</div>
	
	<div class="row pasar" id="data-pasar">
		<?php 
		$col = 1;
		foreach ($item as $key => $value) { ?>

		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 pasar-content">
			<div class="card">
			  <div class="card-body">
	  		  	<div style="display: inline-block;">
	  			    <h5 class="card-title"><strong><?= $value['commodity_name'] ?></strong></h5>
	  			      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#coll-pasar-<?= $col ?>" aria-expanded="false" aria-controls="coll-pasar-<?= $col ?>">
	  			        Show <span class="caret"></span>
	  			      </button>
	  			    </p>
	  			    <div class="collapse" id="coll-pasar-<?= $col ?>">
	  			      <div class="card-body">
	  			      		<img src="" style="width: 100%; height: auto;">
	  			        	<?php 
	  			        	$harga = 0;
	  			        	$total = count($value['market']);
	  			        	foreach ($value['market'] as $keys => $values) { ?>
	  			        	<p><?= $values['market_name'] ?> : <span style="text-align: right;"><?= 'Rp. '.number_format(intval($values['price']),2,',','.') ?></span></p>
	  						<?php 
		  						$harga+=intval($values['price']);
	  						} ?>
	  			      </div>
	  			    </div>
	  			</div>
	  			<div style="float: right; display: inline-block;">
	  				 <p style="font-size: 14px;"><small>Harga Rata-Rata</small></p>
	  			     <h4 class="card-title"><strong>Rp. <?= number_format(intval($harga/$total),2,',','.') ?></strong></h4>
	  			</div>
			  </div>
			</div>
		</div>


		<?php 
			$col++;
		} ?>
	</div>
</div>

                    
<?php 
	
$this->registerJs("
	$('.kabupaten').on('change', function() {
	var id = $('.kabupaten').val();
    $.ajax({
          	url : '" . Yii::$app->urlManager->baseUrl."/pasar/pasar?kota_id='+id,
          	dataType : 'html',
          	success: function (data) {
	            $('#data-pasar').html(data);
	        },
	        error: function (data) {
	        	alert('Terjadi kesalahan')
	        }
      })
     });
   ");

?>  
