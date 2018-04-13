<?php 

use yii\widgets\LinkPager;
$this->title = $model_kategori_post->nama_kategori;
?>

<div class="single-page list">
	<div class="top">
		<div class="title">Berita</div>
	</div>
	
	<div class="article">
		<div class="layout-list1">
	        <div class="row">
	        	<?php foreach ($list_post as $key => $post) { ?>
	            <div class="col-md-4 col-sm-6">
	                <div class="thumbnail news">
	                	<a href="<?= Yii::$app->request->baseUrl ?>/post/detail?content=<?= $post->judul_seo ?>">
	                    <div class="image" style="background-image: url();">
	                    	<img src="<?= Yii::$app->request->baseUrl.Yii::$app->params['uploadUrlPost']."thumb/medium_".$post->gambar ?>" alt="<?= $post->judul ?>">
	                    </div>
	                    </a>
	                    <div class="caption">
	                        <a href="<?= Yii::$app->request->baseUrl ?>/post/detail?content=<?= $post->judul_seo ?>"><h3><?= $post->judul ?></h3></a>
	                        <p class="date">
	                        	<?= $post->hari ?>, <?= $post->tanggal ?> - <?= $post->jam ?>
	                        </p>
	                        <p><?= $post->getStringThumb($post->isi_berita,180) ?></p>
	                    </div>
	                </div>
	            </div>
	            <?php } ?>
	        </div>
        </div>
	</div>
	<div class="box-footer">
		<?php
            echo LinkPager::widget([
                'pagination' => $pages,
                'maxButtonCount' => 7,
            ]);
        ?>      
    </div>
</div>