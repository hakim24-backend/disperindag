<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\mpdf\Pdf;

/* @var $this yii\web\View */
/* @var $model common\models\ActivityDaily */

$this->title = 'Data Kegiatan Rutin Sekretariat';
$this->params['breadcrumbs'][] = ['label' => 'Activity Dailies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

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
<table class="table table-responsive" width="100%" border="1">
	<tbody>
		<tr>
			<td class="text-center">No</td>
			<td class="text-center" width="25%">Nama</td>
			<td class="text-center">Email</td>
			<td class="text-center">Member Sejak</td>
			<td class="text-center">Status</td>
		</tr>
			<?php foreach ($model as $key => $value) { ?>
			<tr>
				<td><?=$no++?></td>
				<td class="text-center"><?=$value->nama?></td>
				<td class="text-center"><?=$value->email?></td>
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
