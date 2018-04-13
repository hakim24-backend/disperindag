<?php 

$this->title = "SAKIP";
?>

<div class="single-page">
	<div class="top">
		<div class="title"><?= $sakip->judul ?></div>
		<div class="td-post-meta">
			
        </div>               
	</div>
	
	<div class="article">
		<?= str_replace("../..", Yii::$app->request->baseUrl, $sakip->deskripsi); ?>
		<div style="clear:both"></div>
	</div>

	<div class="item-sakip">
		<div class="box-content">
		    <div class="box-body">
		     	<ul class="list-group" style="margin:0px">
					
					<?php 
					foreach ($list_sakip_kategori as $key => $value) {
					?>
					<li class="list-group-item" style="<?= ($key%2==0) ? "background-color:#fafafa;" : "" ?> margin:0px; border:none; border-top:solid 1px #ddd; border-radius:0">
						<a href="<?= (count($value->fileSakip)>0) ? Yii::$app->request->baseUrl."/sakip/detail-sakip?no=".$value->id : "#" ?>">
						<div class="row">
							<div class="col-xs-9 name-sakip"><?= $value->nama ?> <small class="date" style="font-size: 14px;">(<?= count($value->fileSakip) ?> file)</small></div>
							<div class="col-xs-3 text-right">
								<?php
								if(count($value->fileSakip)>0){
								?>
								<a href="<?= Yii::$app->request->baseUrl."/sakip/detail-sakip?no=".$value->id ?>" class="btn btn-sm btn-flat btn-success"><i class="fa fa-external-link"></i> Lihat</a>
								<?php
								}
								?>
							</div>
						</div>
						</a>
					</li>
					<?php 
					}
					?>
					
				</ul>  
		    </div>
		</div>
	</div>
</div>

<style type="text/css">
	.item-sakip{
		margin-top: 20px;
		padding-top: 20px;
	}
	.item-sakip td {
	    height: 30px;
	}
	.name-sakip{
		color:#333;
		font-size:18px;
	}
</style>
