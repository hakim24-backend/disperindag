<?php 

use yii\widgets\LinkPager;
$this->title = "Pencarian";
?>

<div class="list-page">
	<div class="box-content">
	    <div class="box-header">
	        <h3 class="title">Pencarian : <?= $_GET['s'] ?></h3>
	    </div>
	    <div class="box-body">
	    	<div class="layout-list1">
	    	<?php if(count($list_post) > 0){ ?>
		        <div class="row">
		        	<?php foreach ($list_post as $key => $post) { ?>
		            <div class="col-md-4 col-sm-6">
		                <div class="thumbnail news">
		                	<a href="<?= Yii::$app->request->baseUrl ?>/post/detail?content=<?= $post->judul_seo ?>">
		                    <div class="image" style="background-image: url(<?= Yii::$app->request->baseUrl.Yii::$app->params['uploadUrlPost'].$post->gambar ?>);" alt="<?= $post->judul ?>"></div>
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
	        
	        <?php 
		        echo LinkPager::widget([
				    'pagination' => $pages,
				    'maxButtonCount' => 5,
				]);
	    	}else{
	    		echo "<p><small class='date' style='font-size:14px;'>Hasil pencarian tidak ditemukan</small></p><br>";
	    		echo "<a href='".Yii::$app->request->baseUrl."/post' class='btn btn-sm btn-primary btn-flat'>Lihat Semua Post</a>";
	    	}
	        ?>
	        </div>
	    </div>
	</div>
</div>