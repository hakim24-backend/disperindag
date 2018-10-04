<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\KataSensor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kata-sensor-form">

	<?= Html::beginForm(); ?>
	<div class="form-group field-katasensor-ganti">
		<label class="control-label" for="katasensor-ganti">Kata Tidak Pantas</label>
		 <?= Html::textarea('kata', $model, ['rows' => 6,'class' => 'form-control']) ?>
	</div> 
    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-flat btn-primary']) ?>
    </div>

    <?= Html::endForm(); ?>

</div>
