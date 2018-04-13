<?php 

$this->title = "Pelayanan ".$model_layanan->nama;
?>

<div class="single-page">
	<div class="top">
		<div class="title"><?= $model_layanan->nama ?></div>
		<div class="td-post-meta">
			<div class="author pull-left">
				Layanan pada instansi <a href="<?= Yii::$app->request->baseUrl ?>/pelayanan/about?content=<?= $model_layanan->instansi->slug ?>"><span class="by"><?= $model_layanan->instansi->nama ?></span></a>
			</div>
            <div class="clear"></div>
        </div>            
	</div>
	
	<div class="article"><?= $model_layanan->diskripsi ?></div>
</div>