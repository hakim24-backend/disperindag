<?php 

use yii\widgets\LinkPager;
$this->title = "Post";

?>

<div class="list-page">
	<div class="box-content">
	    <div class="box-header">
	        <h3 class="title">Berita</h3>
	    </div>
	    <div class="box-body">
	    	<div class="layout-list1">
	    		
	    		<?php foreach ($list_post as $key => $post) { ?>
	    			
	    		<div class="news-item">
	    			<div class="date"><?= $post->hari ?> <?= $post->tanggal ?>, <?= $post->jam ?> WIB</div>
	    			<a href="<?= Yii::$app->request->baseUrl ?>/post/detail?content=<?= $post->judul_seo ?>"><div class="title"><?= $post->judul ?></div></a>
	    		</div>

	    		<?php } ?>

	        </div>
	    </div>
	    <div class="box-footer">
	  		<?php
                        echo LinkPager::widget([
                            'pagination' => $pages,
                            'maxButtonCount' => 5,
                        ]);
                    ?>      
	    </div>
	</div>
</div>