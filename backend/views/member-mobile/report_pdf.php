<?php
$no=1;
?>
<html>
<head>
<style type="text/css">
    <!--
    @page {
              size: 29.7cm 21cm  portrait;   /*A4*/
              padding:0; margin:1;
              top:0; left:0; right:0;bottom:0; border:0;
          }

          @media print {
              .table{
                margin-bottom: 0px;
              }
          }
    }
    -->
</style>
</head>
<body>
<h1 align="center"> <b>Data Member Mobile</b></h1><br>
<table class="table table-responsive" width="100%" border="1">
	<tbody>
		<tr>
			<td class="text-center">No</td>
			<td class="text-center" width="10%">Nama</td>
			<td class="text-center">Email</td>
			<td class="text-center">Instansi</td>
			<td class="text-center">Alamat</td>
			<td class="text-center">No Telepon</td>
			<td class="text-center">Member Sejak</td>
			<td class="text-center">Status</td>
		</tr>
			<?php foreach ($model as $key => $value) { ?>
			<tr>
				<td><?=$no++?></td>
				<td class="text-center"><?=$value->nama?></td>
				<td class="text-center"><?=$value->email?></td>
				<td class="text-center"><?=$value->instansi?></td>
				<td class="text-center"><?=$value->alamat?></td>
				<td class="text-center"><?=$value->no_telp?></td>
				<td class="text-center"><?=date("d M Y",$value->created_at)?></td>
				<?php if ($value->status == 10) { ?>
					<td class="text-center">Aktif</td>
				<?php } else { ?>
					<td class="text-center">Non-Aktif</td>
				<?php } ?>
			</tr>
			<?php } ?>
	</tbody>
</table>
</body>
</html>
