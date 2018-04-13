<?php 

use yii\widgets\LinkPager;
$this->title = "Album ".$model_album->jdl_album;
?>

<div class="list-page">
<div class="box-content">
	<div class="box-header">
		<h3 class="title">Album <?= $model_album->jdl_album ?></h3>
	</div>
	<div class="box-body padding">
		<div class="row photos">
			<?php foreach ($list_photos as $key => $item) { ?>
			<div class="col-md-3 col-sm-4">
				<div class="item">
					<div class="preview-image">
						<a class="example-image-link" href="<?= $item->getPath("show").$item->gbr_gallery ?>" data-lightbox="example-set" data-title="<?= $item->jdl_gallery ?>">
						<img class="example-image" src="<?= $item->getPath("thumb").$item->gbr_gallery ?>" alt="<?= $item->jdl_gallery ?>"/>
						</a>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
	<div class="box-footer">
		<div class="row">
			<div class="col-sm-4">
				<a href="<?= Yii::$app->request->baseUrl ?>/gallery/photo-album" class='btn btn-warning btn-flat btn-sm'><i class='fa fa-angle-left'></i> Kembali ke list Album</a>
			</div>
			<div class="col-sm-8 text-right">
				<?php
					echo LinkPager::widget([
					    'pagination' => $pages,
					    'maxButtonCount' => 5,
					]);
				?>
			</div>
		</div>
	</div>
</div>
</div>