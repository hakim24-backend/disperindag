<?php 

use yii\widgets\LinkPager;
$this->title = "Video";
?>

<div class="list-page">
	<div class="box-content">
	    <div class="box-header">
	        <h3 class="title">Video</h3>
	    </div>
	    <div class="box-body padding">
	    	<?php if (count($list_video) > 0) { ?>
	    	<div class="row">
	    		<?php foreach ($list_video as $key => $video) { ?>
	    		<div class="col-sm-4 col-xs-6 video-item">
	    			<a href="https://www.youtube.com/watch?v=<?= $video->getIdYoutubeVideo() ?>" target="blank">
	    				<img src="http://img.youtube.com/vi/<?= $video->getIdYoutubeVideo() ?>/mqdefault.jpg" class="img-thumbnail">
	    			</a><br>
	    			<small class="date"><?= $video->tgl_posting ?></small>
	    			<a href="https://www.youtube.com/watch?v=<?= $video->url ?>" target="blank">
	    				<p class="text-title"><?= $video->jdl_video ?></p>
	    			</a>
	    		</div>
	    		<?php } ?>
	    	</div>
	    	
	    	<?php 
			}else{
			 	echo "<small style='color:#999; font-style:italic'>Masih belum ada video yang di posting</small>";
			}
			?>
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