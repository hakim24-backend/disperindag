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
				<?php echo Html::dropDownList('kabupaten', '', ['M'=>'Male', 'F'=>'Female'], ['prompt' => 'Pilih Kota/Kabupaten']); ?>
			</div>
		</div>
	</div>
	
	<div class="row pasar">
		<?php 
		$col = 1;
		foreach ($item as $key => $value) { ?>

		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 pasar-content">
			<div class="card">
			  <div class="card-body">
	  		  	<div style="display: inline-block;">
	  			    <h5 class="card-title"><strong>Beras IR64 (kw premium)</strong></h5>
	  			      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#coll-pasar-<?= $col ?>" aria-expanded="false" aria-controls="coll-pasar-<?= $col ?>">
	  			        Show <span class="caret"></span>
	  			      </button>
	  			    </p>
	  			    <div class="collapse" id="coll-pasar-<?= $col ?>">
	  			      <div class="card-body">
	  			      		<img src="" style="width: 100%; height: auto;">
	  			        	<p>Pasar Johar Rp. 12,000</p>
	  						<p>Pasar Peterongan Rp. 12,000</p>
	  						<p>Pasar Karangayu Rp. 12,000</p>
	  						<p>Pasar Bulu Rp. 11,700</p>
	  						<p>Pasar Gayamsari Rp. 11,700</p>
	  			      </div>
	  			    </div>
	  			</div>
	  			<div style="float: right; display: inline-block;">
	  				 <p style="font-size: 14px;"><small>Harga Rata-Rata</small></p>
	  			     <h4 class="card-title"><strong>Rp. 11.780</strong></h4>
	  			</div>
			  </div>
			</div>
		</div>


		<?php 
			$col++;
		} ?>
	</div>

</div>

                    

