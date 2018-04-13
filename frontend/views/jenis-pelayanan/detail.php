<?php

$this->title = $model_jenis_pelayanan->judul;
?>

<div class="single-page">
	<div class="top">
		<div class="title">Jenis Pelayanan <?= $model_jenis_pelayanan->judul ?></div>
		<div class="td-post-meta">
			<div class="author pull-left">
				Diposting oleh <span class="by">Administrator</span>-<span class="date"><?= $model_jenis_pelayanan->tgl_posting ?></span>
			</div>
            <div class="clear"></div>
        </div>
	</div>
	<div class="article"><?= $model_jenis_pelayanan->isi_halaman; ?></div>	
	<hr>
	<a href="<?= Yii::$app->request->baseUrl ?>/jenis-pelayanan" class='btn btn-warning btn-flat btn-sm'><i class='fa fa-angle-left'></i> Kembali ke daftar jenis pelayanan</a>
</div>

