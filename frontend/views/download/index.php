<?php
/* @var $this yii\web\View */

$this->title = "Download";
?>

<div class="list-page">
	<div class="box-content">
	    <div class="box-header">
	        <h3 class="title">Kategori Download</h3>
	    </div>
	    <div class="box-body">
	     	<ul class="list-group" style="margin:0px">
				<?php foreach ($list_kategori_download as $kategori_download) { ?>
				<li class="list-group-item" style="margin:0px; border:none; border-top:solid 1px #ddd; border-radius:0">
					<a href="<?= Yii::$app->request->baseUrl ?>/download/enter?content=<?= $kategori_download->kategori_seo ?>">
					<div class="row">
						<div class="col-xs-9"><?= $kategori_download->nama_kategori ?> 
						<small class="date" style="font-size: 14px;">(<?= $kategori_download->getJumlahFile() ?> file)</small></div>
						
						<div class="col-xs-3 text-right">
							<a href="<?= Yii::$app->request->baseUrl ?>/download/enter?content=<?= $kategori_download->kategori_seo ?>" class="btn btn-sm btn-flat btn-success"><i class="fa fa-external-link"></i> Lihat</a>
						</div>
					</div>
					</a>
				</li>
				<?php } ?>
			</ul>  
	    </div>
	</div>
</div>

