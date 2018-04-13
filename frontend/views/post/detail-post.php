<?php 
use lslsoft\poll\Poll;

$this->title = $model_post->judul;
?>

<!-- Facebook Comment -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=969604923086449";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- End Facebook Comment -->

<div class="single-page">
	<div class="top">
		<div class="title"><?= $model_post->judul ?></div>
		<div class="td-post-meta">
			<div class="author pull-left">
				<span class="kategori">
					<i class="fa fa-list"></i> 
					<?php if($model_post->kategoriPost != null){ ?>
					<a href="<?= Yii::$app->request->baseUrl ?>/post/kategori?content=<?= $model_post->kategoriPost->kategori_seo ?>">Kategori <?= $model_post->kategoriPost->nama_kategori ?></a>
					<?php }else{ 
						echo "Uncategorized";
					} ?>
				</span> 
				Diposting oleh 
					<span class="by"><?= $model_post->username ?></span>-
					<span class="date"><?= $model_post->hari ?>, <?= $model_post->tanggal ?></span>
			</div>
            <div class="shown pull-right">
            	<i class="fa fa-eye"></i> <?= number_format($model_post->dibaca) ?>
            </div>
            <div class="clear"></div>
        </div>               
	</div>
	
	<!-- Go to www.addthis.com/dashboard to customize your tools -->
	<div class="addthis_sharing_toolbox"></div>

	<div class="image-thumb">
		<img src="<?= Yii::$app->request->baseUrl.Yii::$app->params['uploadUrlPost']."single/".$model_post->gambar ?>" width="100%">
	</div>
	<div class="article"><?= $model_post->isi_berita ?></div>
	
	<div class="tags-wrap row">
		<?php 
			if($model_post->tag!=""){
				echo "<br><hr>";
				echo "<div class='col-sm-1 col-xs-12'><label>Tags:</label></div><div class='col-sm-11 col-xs-12'>";
				$tags = explode(",", $model_post->tag);
				foreach ($tags as $key => $tag) {
					echo '<a href="'.Yii::$app->request->baseUrl.'/post/tag?content='.$tag.'" class="label label-primary">'.$tag.'</a> ';
				}
				echo "</div>";
			}
		?>
	</div>
	<br>
	<div class="polling">
		<?php
		echo Poll::widget([
				'idPoll' => 9,
				'berita'=>$model_post->id_berita,
			]);
		?>
	</div>

	<?php if(count($list_related_post) > 0){ ?>
	<hr>
	
	<div class="box-posting-terkait">
		<div class="box-content">
            <div class="box-header">
                <h3 class="title">Post Terkait</h3>
            </div>
            <div class="box-body">
				<?php foreach ($list_related_post as $key => $post) {
					if($key==0 || $key==4)
						echo '<div class="row">';
					?>
					<div class="col-sm-3">
						<div class="thumbnail news" style="height:auto">
		                    <div class="image" style="background-image: url(<?= Yii::$app->request->baseUrl.Yii::$app->params['uploadUrlPost'].str_replace(' ','%20',$post['gambar']) ?>);"></div>
		                    <div class="caption">
		                        <a href="<?= Yii::$app->request->baseUrl ?>/post/detail?content=<?= $post['judul_seo'] ?>">
		                        	<h3><?= strip_tags($post['judul']) ?></h3>
		                        </a>
		                    </div>
		                </div>
					</div>
					<?php 
					if($key==3 || $key==count($list_related_post)-1)
						echo '</div>';
				} ?>
            </div>
        </div>
	</div>
	<?php } ?>
	
	<hr>
	<div class="box-comment">
		<div class="fb-comments" data-href="http://disperindag.jatimprov.go.id/<?= $model_post->judul_seo ?>" data-width="100%" data-numposts="5"></div>
	</div>

</div>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52d53e7930988e7d"></script>
