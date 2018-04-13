<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Login';
?>

<div class="login-box">
  <div class="box-header">
    <div class="text1">Administrator</div>
    <div class="text2">Disperindag Jatim</div>
    <hr>
  </div>
  <div class="login-box-body">
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        
        <?= $form->field($model, 'username', [
          'template'=>'{label}<div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        {input}
                      </div>
                      '
        ])->textInput(['placeholder'=>'Username'])->label(false) ?>

        <?= $form->field($model, 'password', [
          'template'=>'{label}<div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        {input}
                      </div>
                      {error}'
        ])->passwordInput(['placeholder'=>'Password'])->label(false) ?>

        <div class="row">
          <div class="col-xs-12">
            <?= Html::submitButton('Login Administrator', ['class' => 'btn btn-primary btn-flat', 'name' => 'login-button']) ?>
          </div>
        </div>
    <?php ActiveForm::end(); ?>

  </div><!-- /.login-box-body -->
  <div class="box-footer">
    Copyright © 2016 Disperindag Prov. Jatim. All rights reserved.
  </div>
</div><!-- /.login-box -->
