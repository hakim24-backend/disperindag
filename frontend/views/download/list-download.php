<?php 

$this->title = "Download ".$model_kategori_download->nama_kategori;
?>

<div class="list-page">
	<div class="box-content">
		<div class="box-header">
			<h3 class="title">Download - <?= $model_kategori_download->nama_kategori ?></h3>
		</div>
		<div class="box-body padding">
			<table class="datatable stripe cell-border hover order-column">
				<thead>
					<tr>
						<th width="1px;"></th>
						<th>Nama File</th>
						<th width="10px"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($list_download as $key => $file_download) { 
						$extension = "";
						$file = explode('.', $file_download->nama_file);
						if(count($file)>1)
							$extension = "(".$file[1].")";
					?>
					<tr>
						<td class="text-center" style="vertical-align: middle;"><?= $key+1 ?></td>
						<td>
							<p><?= $file_download->judul." ".$extension ?></p>
							<small class="date">Tanggal posting : <?= $file_download->tgl_posting ?> | Total hits : <?= $file_download->hits ?></small>
						</td>
						<td style="vertical-align: middle;">
							<a href="<?= Yii::$app->request->baseUrl ?>/download/download?file=<?= $file_download->nama_file ?>" class="btn btn-success btn-flat btn-sm"><i class='fa fa-download'></i> Download
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php 
	$this->registerJs("
		$('.datatable').DataTable();
	");
?>
<style type="text/css">
	table.datatable{
		margin-top: 20px;
	}
	table.datatable thead th{
		background-color: #fff;
		border-top:solid 1px #000;
	}
</style>