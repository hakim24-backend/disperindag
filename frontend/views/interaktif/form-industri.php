<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
// use yii\captcha\Captcha;
// use yii\widgets\LinkPager;
use yii\web\View;

$this->title = 'Pengajuan Industri';
$this->params['breadcrumbs'][] = $this->title;

// $this->registerJs(
//     "$('#btn-list').on('click', function() {
//         // alert('Button clicked!');
//         $('#industri').hide();
//         $('#daftar-industri').show();

//     });",
//     View::POS_READY,
//     'my-button-handler'
// );

// $this->registerJsFile("@web/js/industri.js",['depends' => 'yii\web\JqueryAsset']);
?>
<div class="list-page">
    <div class="box-content">
        <!-- <div class="box-header">
            <div class="pull-right box-tools"><a href="#" class="btn btn-sm btn-default btn-flat" id="btn-list">Lihat Daftar Industri Anda disini</a></div>
        </div> -->
        <div class="box-body padding" id="form-industri">
            <div class="form">
                <div class="title">Silahkan isi masukkan anda dibawah ini:</div>
                <?php $form = ActiveForm::begin(); ?>
                <?php
                    $wizard_config = [
                        'id' => 'stepwizard',
                        'steps' => [
                        1 => [
                            'title' => 'Step 1',
                            'icon' => 'glyphicon glyphicon-align-left',
                            'content' => $this->render('form-industri-step-1', ['form' => $form, 'model' => $model]),
                        ],
                        2 => [
                            'title' => 'Step 2',
                            'icon' => 'glyphicon glyphicon-align-center',
                            'content' => $this->render('form-industri-step-2', ['form' => $form, 'model' => $model]),
                        ],
                        3 => [
                            'title' => 'Step 3',
                            'icon' => 'glyphicon glyphicon-align-right',
                            'content' => $this->render('form-industri-step-3', ['form' => $form, 'model' => $model]),
                            'buttons' => [
                                'previous' => [
                                    'title' => 'Previous', 
                                    'options' => [
                                        // 'class' => 'disabled'
                                    ],
                                 ],
                                'save' => [
                                    'title' => 'Save', 
                                    'options' => [
                                        // 'class' => 'disabled'
                                    ],
                                 ],
                             ],
                        ],
                    ],
                    // 'complete_content' => "Terima kasih atas partisipasi anda!", // Optional final screen
                    'start_step' => 1, // Optional, start with a specific step
                ];
                ?>
                <?= \drsdre\wizardwidget\WizardWidget::widget($wizard_config); ?>
            </div>
        </div>
    </div>
</div>


<div id="myModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: none;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
            <strong>
            <?php 
            if(Yii::$app->session->getFlash('success')){
                echo '<div class="alert alert-success" role="alert">';
                echo "Sukses";
            }else{
                echo '<div class="alert alert-danger" role="alert">';
                echo "Error";
            }
            ?>
            !</strong> <?= Yii::$app->session->getFlash('success') ?><?= Yii::$app->session->getFlash('error') ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php 
if(Yii::$app->session->getFlash('success') != null){
    $this->registerJs("$('#myModal').modal('show');", View::POS_END);
}
?>