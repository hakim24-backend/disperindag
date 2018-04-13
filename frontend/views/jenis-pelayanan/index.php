<?php

$this->title = "Jenis Pelayanan";
?>

<div class="list-page">
	<div class="box-content">
	    <div class="box-header">
	        <h3 class="title">Jenis Pelayanan</h3>
	    </div>
	    <div class="box-body">
	     	<ul class="list-group">
				<?php foreach ($list_jenis_pelayanan as $jenis_pelayanan) { ?>
				<li class="list-group-item">
					<a href="<?= Yii::$app->request->baseUrl ?>/jenis-pelayanan/detail?content=<?= $jenis_pelayanan->slug ?>">
					<div class="row">
						<div class="col-sm-3"><?= $jenis_pelayanan->judul ?></div>
						<div class="col-sm-6"><small class="date">Diposting pada <?= $jenis_pelayanan->tgl_posting ?></small></div>
						<div class="col-sm-3 text-right">
							<a href="<?= Yii::$app->request->baseUrl ?>/jenis-pelayanan/detail?content=<?= $jenis_pelayanan->slug ?>" class="btn btn-sm btn-flat btn-success"><i class="fa fa-external-link"></i> Lihat</a>
						</div>
					</div>
					</a>
				</li>
				<?php } ?>
			</ul>  
	    </div>
	</div>
</div>

