<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AccountSubbag */

$this->title = 'Create Account Subbag';
$this->params['breadcrumbs'][] = ['label' => 'Account Subbags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-subbag-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
