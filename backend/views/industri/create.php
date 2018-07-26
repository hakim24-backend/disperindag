<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Industri */

$this->title = 'Create Industri';
$this->params['breadcrumbs'][] = ['label' => 'Industris', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="industri-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
