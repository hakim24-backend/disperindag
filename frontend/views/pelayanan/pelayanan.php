<?php 

$this->title = "Pelayanan ".$model_pelayanan->nama;
?>

<div class="single-page">
	<div class="top">
		<div class="title"><?= $model_pelayanan->nama ?></div>
		<div class="td-post-meta">
			
        </div>               
	</div>
	
	<div class="article"><?= $model_pelayanan->diskripsi ?></div>
	
	<div class="jenis-pelayanan-wrap">
	<ul class="list-group">
		
		<?php foreach ($list_layanan as $key => $layanan) { ?>
		<li class="list-group-item">
			<a href="<?= Yii::$app->request->baseUrl ?>/pelayanan/layanan?content=<?= $layanan->slug ?>">
			<div class="row">
				<div class="col-sm-9"><?= $layanan->nama ?></div>
				<div class="col-sm-3 text-right">
					<a href="<?= Yii::$app->request->baseUrl ?>/pelayanan/layanan?content=<?= $layanan->slug ?>" class="btn btn-sm btn-flat btn-success"><i class="fa fa-external-link"></i> Lihat</a>
				</div>
			</div>
			</a>
		</li>
		<?php } ?>

	</ul>  
	</div>

</div>

<?php
	
?>

<style type="text/css">
	.jenis-pelayanan-wrap{
		margin-top: 30px;
	}
</style>
