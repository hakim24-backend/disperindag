<?php
/* @var $this yii\web\View */
use yii\helpers\Html; 
$this->registerJsFile("@web/frontend/web/js/datatable.js",['depends' => 'yii\web\JqueryAsset']);
$this->title = "Direktori Pasar";
?>

<div class="single-page">
	<div class="top">
		<div class="title">Direktori Industri</div>
		<div class="td-post-meta">	
		</div>               
	</div>

	<div class="row">
		<div id="w0" class="table-responsive">
			<table class="table table-striped table-bordered responsive-utilities jambo_table industri">
				<thead>
					<th>No</th>
					<th>Nama Perusahaan</th>
					<th>Alamat</th>
					<th>Produk Utama</th>
					<th>KBLI</th>
					<th>Nomor Telepon</th>
				</thead>
				<tbody>
					<?php
					$no=1; 
					foreach ($model as $key => $value) { 
						?>
						
						<tr>
							<td><?=$no++?></td>
							<td><?=$value->nama_perusahaan?></td>
							<td><?=$value->jalan?></td>
							<td><?=$value->jenis_produk?></td>
							<td><?=$value->kbli?></td>
							<td><?=$value->telepon?></td>
						</tr>

					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php 
	
$this->registerJs("
	$(document).ready(function() {
	      $('.industri').DataTable({
      'columnDefs': [{
        'orderable': false,
        'targets': -1
      }],
    });
	});
");

?>
