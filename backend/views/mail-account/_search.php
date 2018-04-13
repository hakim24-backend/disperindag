<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MailAccountSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mail-account-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'accountid') ?>

    <?= $form->field($model, 'accountdomainid') ?>

    <?= $form->field($model, 'accountadminlevel') ?>

    <?= $form->field($model, 'accountaddress') ?>

    <?= $form->field($model, 'accountpassword') ?>

    <?php // echo $form->field($model, 'accountactive') ?>

    <?php // echo $form->field($model, 'accountisad') ?>

    <?php // echo $form->field($model, 'accountaddomain') ?>

    <?php // echo $form->field($model, 'accountadusername') ?>

    <?php // echo $form->field($model, 'accountmaxsize') ?>

    <?php // echo $form->field($model, 'accountvacationmessageon') ?>

    <?php // echo $form->field($model, 'accountvacationmessage') ?>

    <?php // echo $form->field($model, 'accountvacationsubject') ?>

    <?php // echo $form->field($model, 'accountpwencryption') ?>

    <?php // echo $form->field($model, 'accountforwardenabled') ?>

    <?php // echo $form->field($model, 'accountforwardaddress') ?>

    <?php // echo $form->field($model, 'accountforwardkeeporiginal') ?>

    <?php // echo $form->field($model, 'accountenablesignature') ?>

    <?php // echo $form->field($model, 'accountsignatureplaintext') ?>

    <?php // echo $form->field($model, 'accountsignaturehtml') ?>

    <?php // echo $form->field($model, 'accountlastlogontime') ?>

    <?php // echo $form->field($model, 'accountvacationexpires') ?>

    <?php // echo $form->field($model, 'accountvacationexpiredate') ?>

    <?php // echo $form->field($model, 'accountpersonfirstname') ?>

    <?php // echo $form->field($model, 'accountpersonlastname') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
