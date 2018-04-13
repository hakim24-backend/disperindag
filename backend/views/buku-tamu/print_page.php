<a href="index" class="btn btn-default">Kembali</a>

<div class="wrap-wrap">
<div class="wrap">
<?php 
if(!empty($dataPrint)){
	foreach ($dataPrint as $key => $value) {
		?>
		<div class="item">
		<table class="table table-striped table-bordered">
		<tr>
			<td style="width:100px"><label>Tanggal</label></td>
			<td><?= $value->tanggal ?></td>
		</tr>
		<tr>
			<td><label>Nama</label></td>
			<td><?= $value->nama ?></td>
		</tr>
		<tr>
			<td><label>Email</label></td>
			<td><?= $value->email ?></td>
		</tr>
		<tr>
			<td><label>Subjek</label></td>
			<td><?= $value->subjek ?></td>
		</tr>
		<tr>
			<td><label>Pesan</label></td>
			<td><?= nl2br($value->pesan) ?></td>
		</tr>
		</table>
		</div>
		<br>
		<?php 
	}
}
?>
</div>
</div>

<style type="text/css">
	body{
		background-color: #fbfbfb !important;
	}
	.wrap-wrap{
		padding:20px;
	}
	.wrap{
		border:solid 1px #ddd;
		padding:20px;
	}
	.item{
		border:solid 1px #ccc !important;
	}
</style>

<script type="text/javascript">
	window.print();
</script>