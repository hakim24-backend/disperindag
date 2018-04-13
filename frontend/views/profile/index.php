<?php 

$this->title = "Profil";
?>

<div class="single-page">
	<div class="top">
		<div class="title"><?= $this->title ?></div>
		<div class="td-post-meta">
			
        </div>               
	</div>
	
	<div class="jenis-peitem-wrap">
	<ul class="list-group">
		<?php foreach ($model as $key => $item) { ?>
		<li class="list-group-item">
			<a href="<?= Yii::$app->request->baseUrl ?>/profile/about?content=<?= $item->slug ?>">
			<div class="row">
				<div class="col-sm-12"><?= $item->judul ?></div>
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
	.jenis-peitem-wrap{
		margin-top: 30px;
	}
</style>
