<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MailAccount */

$this->title = 'Update Mail Account: ' . ' ' . $model->accountid;
$this->params['breadcrumbs'][] = ['label' => 'Mail Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->accountid, 'url' => ['view', 'id' => $model->accountid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mail-account-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
