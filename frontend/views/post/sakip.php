<?php 

$this->title = "SAKIP";
?>

<div class="single-page">
	<div class="top">
		<div class="title">SAKIP</div>
		<div class="td-post-meta">
			
        </div>               
	</div>
	
	<div class="article">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
	
	<div class="item-file-sakip">
		<table class="datatable stripe">
			<thead>
				<tr>
					<th colspan="2" style="font-size:18px;">LAKIP 2014</th>
				</tr>
				<tr style="display:none">
					<th>Nama File</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>BAB I</td>
					<td width="10px"><a class="btn btn-sm btn-success btn-flat">Download</a></td>
				</tr>
				<tr>
					<td>BAB I</td>
					<td><a class="btn btn-sm btn-success btn-flat">Download</a></td>
				</tr>
				<tr>
					<td>BAB I</td>
					<td><a class="btn btn-sm btn-success btn-flat">Download</a></td>
				</tr>
				<tr>
					<td>BAB I</td>
					<td><a class="btn btn-sm btn-success btn-flat">Download</a></td>
				</tr>
				<tr>
					<td>BAB II</td>
					<td><a class="btn btn-sm btn-success btn-flat">Download</a></td>
				</tr>
				<tr>
					<td>BAB III</td>
					<td><a class="btn btn-sm btn-success btn-flat">Download</a></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td></td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="item-file-sakip">
		<table class="datatable stripe">
			<thead>
				<tr>
					<th colspan="2" style="font-size:18px;">LAKIP 2014</th>
				</tr>
				<tr style="display:none">
					<th>Nama File</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>BAB I</td>
					<td width="10"><a class="btn btn-sm btn-success btn-flat">Download</a></td>
				</tr>
				<tr>
					<td>BAB I</td>
					<td><a class="btn btn-sm btn-success btn-flat">Download</a></td>
				</tr>
				<tr>
					<td>BAB I</td>
					<td><a class="btn btn-sm btn-success btn-flat">Download</a></td>
				</tr>
				<tr>
					<td>BAB I</td>
					<td><a class="btn btn-sm btn-success btn-flat">Download</a></td>
				</tr>
				<tr>
					<td>BAB II</td>
					<td><a class="btn btn-sm btn-success btn-flat">Download</a></td>
				</tr>
				<tr>
					<td>BAB III</td>
					<td><a class="btn btn-sm btn-success btn-flat">Download</a></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="item-file-sakip">
		<table class="datatable stripe">
			<thead>
				<tr>
					<th colspan="2" style="font-size:18px;">LAKIP 2014</th>
				</tr>
				<tr style="display:none">
					<th>Nama File</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>BAB I</td>
					<td width="10"><a class="btn btn-sm btn-success btn-flat">Download</a></td>
				</tr>
				<tr>
					<td>BAB I</td>
					<td><a class="btn btn-sm btn-success btn-flat">Download</a></td>
				</tr>
				<tr>
					<td>BAB I</td>
					<td><a class="btn btn-sm btn-success btn-flat">Download</a></td>
				</tr>
				<tr>
					<td>BAB I</td>
					<td><a class="btn btn-sm btn-success btn-flat">Download</a></td>
				</tr>
				<tr>
					<td>BAB II</td>
					<td><a class="btn btn-sm btn-success btn-flat">Download</a></td>
				</tr>
				<tr>
					<td>BAB III</td>
					<td><a class="btn btn-sm btn-success btn-flat">Download</a></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="item-file-sakip">
		<table class="datatable stripe">
			<thead>
				<tr>
					<th colspan="2" style="font-size:18px;">LAKIP 2014</th>
				</tr>
				<tr style="display:none">
					<th>Nama File</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>BAB I</td>
					<td width="10"><a class="btn btn-sm btn-success btn-flat">Download</a></td>
				</tr>
				<tr>
					<td>BAB I</td>
					<td><a class="btn btn-sm btn-success btn-flat">Download</a></td>
				</tr>
				<tr>
					<td>BAB I</td>
					<td><a class="btn btn-sm btn-success btn-flat">Download</a></td>
				</tr>
				<tr>
					<td>BAB I</td>
					<td><a class="btn btn-sm btn-success btn-flat">Download</a></td>
				</tr>
				<tr>
					<td>BAB II</td>
					<td><a class="btn btn-sm btn-success btn-flat">Download</a></td>
				</tr>
				<tr>
					<td>BAB III</td>
					<td><a class="btn btn-sm btn-success btn-flat">Download</a></td>
				</tr>
			</tbody>
		</table>
	</div>

</div>

<?php
	$this->registerJs("
		$('.datatable').DataTable({
			'pageLength': 5,
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
</style>
