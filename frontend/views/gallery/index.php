<?php 

$this->title = "Galeri";
?>

<div class="single-page">
	<div class="top">
		<div class="title"><?= $this->title ?></div>
		<div class="td-post-meta">
			
        </div>               
	</div>
	
	<div class="jenis-peitem-wrap">
	<ul class="list-group">
		
		<li class="list-group-item">
			<a href="<?= Yii::$app->request->baseUrl ?>/gallery/photo-album">
			<div class="row">
				<div class="col-sm-12">Foto</div>
			</div>
			</a>
		</li>
		<li class="list-group-item">
			<a href="<?= Yii::$app->request->baseUrl ?>/gallery/video">
			<div class="row">
				<div class="col-sm-12">Video</div>
			</div>
			</a>
		</li>
		
	</ul>  
	</div>

</div>

<?php
	
?>

<style type="text/css">
	.jenis-peitem-wrap{
		margin-top: 30px;
	}
</style>
