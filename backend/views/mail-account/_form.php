<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MailAccount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mail-account-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'accountdomainid')->textInput() ?>

    <?= $form->field($model, 'accountadminlevel')->textInput() ?>

    <?= $form->field($model, 'accountaddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'accountpassword')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'accountactive')->textInput() ?>

    <?= $form->field($model, 'accountisad')->textInput() ?>

    <?= $form->field($model, 'accountaddomain')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'accountadusername')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'accountmaxsize')->textInput() ?>

    <?= $form->field($model, 'accountvacationmessageon')->textInput() ?>

    <?= $form->field($model, 'accountvacationmessage')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'accountvacationsubject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'accountpwencryption')->textInput() ?>

    <?= $form->field($model, 'accountforwardenabled')->textInput() ?>

    <?= $form->field($model, 'accountforwardaddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'accountforwardkeeporiginal')->textInput() ?>

    <?= $form->field($model, 'accountenablesignature')->textInput() ?>

    <?= $form->field($model, 'accountsignatureplaintext')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'accountsignaturehtml')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'accountlastlogontime')->textInput() ?>

    <?= $form->field($model, 'accountvacationexpires')->textInput() ?>

    <?= $form->field($model, 'accountvacationexpiredate')->textInput() ?>

    <?= $form->field($model, 'accountpersonfirstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'accountpersonlastname')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
