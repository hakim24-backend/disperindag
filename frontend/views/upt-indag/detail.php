<?php

$this->title = $model_upt_indag->judul;
?>

<div class="single-page">
	<div class="top">
		<div class="title">Pelayanan <?= $model_upt_indag->judul ?></div>
		<div class="td-post-meta">
			<div class="author pull-left">
				Diposting oleh <span class="by">Administrator</span>-<span class="date"><?= $model_upt_indag->tgl_posting ?></span>
			</div>
            <div class="clear"></div>
        </div>
	</div>
	<div class="image-thumb">
		<img src="<?= Yii::$app->request->baseUrl ?>/common/uploaded/other/<?= $model_upt_indag->gambar ?>">
	</div>
	<div class="article"><?= str_replace("../..", Yii::$app->request->baseUrl, $model_upt_indag->isi_halaman); ?></div>	
</div>

