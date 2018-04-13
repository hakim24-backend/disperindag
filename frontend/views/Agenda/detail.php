<?php
/* @var $this yii\web\View */
$this->title = "Agenda";
?>

<div class="single-page">

	<div class="top">
		<div class="title"><?= $model_agenda->tema ?></div>
		<div class="td-post-meta">
			<small class="date">Diposting tanggal: <?= date("d-m-Y",strtotime($model_agenda->tgl_posting)) ?></small>
		</div>
	</div>
	<div class="article">
		<label>Topik:</label>
		<p><?= $model_agenda->isi_agenda ?></p>
		<hr>
		<div class="row">
			<div class="col-sm-6">
				<label>Tanggal:</label>
				<p><?= date("d M Y",strtotime($model_agenda->tgl_mulai)) ?> s/d <?= date("d M Y",strtotime($model_agenda->tgl_selesai)) ?></p>
				<br>				
				<label>Pukul:</label>
				<p><?= $model_agenda->jam ?></p>
			</div>
			<div class="col-sm-6">
				<label>Tempat:</label>
				<p><?= $model_agenda->tempat ?></p>
			</div>
		</div>
		<hr>
		<label>Pengirim (Contact Person):</label>
		<p><?= $model_agenda->pengirim ?></p>
	</div>
</div>