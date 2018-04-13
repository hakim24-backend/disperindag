<?php

$this->title = $model_profile->judul;
?>

<div class="single-page">
	<div class="top">
		<div class="title"><?= $model_profile->judul ?></div>
		<div class="td-post-meta">
			<div class="author pull-left">
				<!--<span class="kategori"><i class="fa fa-list"></i> <a href="#">Kategori Berita</a></span> -->Diposting oleh <span class="by">Administrator</span>-<span class="date"><?= $model_profile->tgl_posting ?></span>
			</div>
            <!--<div class="shown pull-right">
            	<i class="fa fa-eye"></i> 345
            </div>-->
            <div class="clear"></div>
        </div>
	</div>
	<div class="article">
		<?= str_replace("../..", Yii::$app->params['replacementImageUrlResultElfinder'], $model_profile->isi_halaman); ?>
	</div>
</div>

