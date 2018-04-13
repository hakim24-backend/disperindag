<?php 

use yii\widgets\LinkPager;
$this->title = "Agenda";
?>

<div class="single-page list">
	<div class="box-content">
		<div class="box-header">
			<h3 class="title">Agenda</h3>
		</div>
	</div>
	<div class="article">
		<div class="layout-list1">
			<div class="list">	
				<?php foreach ($list_agenda as $key => $agenda) { ?>
				<div class="item agenda">
					<label><?= $agenda->tema ?></label>
					<small class="date"><?= $agenda->formatDate($agenda->tgl_mulai) ?> s/d <?= $agenda->formatDate($agenda->tgl_selesai) ?></small>
					<a href="<?= Yii::$app->request->baseUrl ?>/agenda/detail?content=<?= $agenda->tema_seo ?>" class="btn btn-success btn-flat btn-sm"><i class="fa fa-external-link"></i> Lihat detail</i></a>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="box-footer">
		<?php
            echo LinkPager::widget([
                'pagination' => $pages,
                'maxButtonCount' => 7,
            ]);
        ?>      
    </div>
</div>