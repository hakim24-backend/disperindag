<?php 

use yii\widgets\LinkPager;
$this->title = "Album Foto";
?>

<div class="list-page">
	<div class="box-content">
	    <div class="box-header">
	        <h3 class="title">Album Foto</h3>
	    </div>
	    <div class="box-body padding">
	    	<div class="row album">
	    		<?php foreach ($list_album as $key => $item) { 
	    			if(count($item->photos) > 0){?>
	    			<div class="col-sm-4">
		    			<div class="item">
		    				<a href="<?= Yii::$app->request->baseUrl ?>/gallery/photos?content=<?= $item->album_seo ?>">
			    			<div class="preview-image" style="background-image: url(<?= $item->photos[0]->getPath("thumb").str_replace(' ','%20',$item->photos[0]->gbr_gallery) ?>)"></div></a>
			    			<div class="keterangan">
			    				<div class="text1">
			    					<a href="<?= Yii::$app->request->baseUrl ?>/gallery/photos?content=<?= $item->album_seo ?>">
			    						<?= $item->jdl_album ?>
			    					</a>
			    				</div>
			    				<div class="text2"><?= count($item->photos) ?> Foto</div>
			    			</div>
			    		</div>
		    		</div>
	    		<?php } } ?>
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