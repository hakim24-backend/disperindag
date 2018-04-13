<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\Feedback */

// $this->title = $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Feedbacks', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
$this->title = "Detail Feedback";
?>
<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
     <li><a href="index"><i class="fa fa-book"></i>Feedback</a></li>
     <li class="active">Detail</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger btn-flat',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
            <div class="pull-right box-tools"><a href="index" class="btn btn-sm btn-default btn-flat">Kembali</a></div>
        </div>
        <div class="box-body">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'tanggal',
                    'nama',
                    'email:email',
                    'subject',
                    'feedback:ntext',
                ],
            ]) ?>
        </div>
    </div>
</section>

<style type="text/css">
    .item{
        border:dotted 1px #ddd;
        padding: 15px;
        margin-bottom: 10px;
    }
    .item .subjek{
        font-weight: bold;
        font-size: 16px;
    }
    .item .date{
        font-size: 12px;
        color: #999;
    }
    .item .pesan{
        margin-top: 5px;
    }
    .balasan-buku-tamu p{
        margin:0px;
    }
</style>