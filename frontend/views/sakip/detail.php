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

	<div class="item-file-sakip">
			<table class="datatable stripe">
				<thead>
					<tr>
						<th style="font-size:18px;"><?= $file_sakip[0]->kategori->nama; ?></th>
						<th class="text-right"><a class="btn btn-sm btn-default btn-flat" href="<?= Yii::$app->request->baseUrl."/sakip" ?>"><i class="fa fa-angle-left"></i> Kembali</a></th>
					</tr>
					<tr style="display:none">
						<th>Nama File</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					
					<?php 
					foreach ($file_sakip as $key => $value) {
					?>
					<tr>
						<td><?= $value->nama ?></td>
						<td width="150" class="text-right">
							<a target="blank" href="<?= ($value->file != NULL) ? Yii::$app->request->baseUrl ."/".Yii::$app->params['uploadUrlFile']."sakip/".$value->file : $value->url ?>" class="btn btn-sm btn-warning btn-flat">Lihat</a>
							<a href="<?= Yii::$app->request->baseUrl ?>/sakip/download?file=<?= base64_encode($value->id) ?>" class="btn btn-sm btn-success btn-flat">Download</a>
						</td>
					</tr>
					<?php
					}
					?>					
				</tbody>
			</table>
		</div>
</div>

<?php
	$this->registerJs("
		$('.datatable').DataTable({
			'pageLength': 10,
			'bLengthChange': false,
			'bFilter': false,
			'aaSorting': [],
		});
	");
?>

<style type="text/css">
	.item-file-sakip{
		border-top:solid 1px #ddd;
		margin-top: 20px;
		padding-top: 20px;
	}
	.item-file-sakip td {
	    height: 30px;
	}
	table.dataTable thead th, table.dataTable thead td {
	    padding: 10px 8px;
	    border-bottom: 1px solid #111;
	}
</style>
