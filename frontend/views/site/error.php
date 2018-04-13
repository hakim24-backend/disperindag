<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

if($name = "Not Found (#404)")
    $name = "Halaman yang Anda Cari Tidak Ditemukan";

$this->title = "#404 Not Found";
?>


<div class="box-content">
    
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-danger">
                    <?= nl2br(Html::encode($message)) ?>
                </div>
                <small>
                <p>
                    Halaman yang Anda cari tidak ditemukan.
                    
                    <!--The above error occurred while the Web server was processing your request.-->
                </p>
                <p>
                    <!--Please contact us if you think this is a server error. Thank you.-->
                    Bisa jadi karena url tersebut salah atau tidak tersedia.
                </p>
                </small>
                <br>
                <a href="<?= Yii::$app->request->baseUrl ?>" class="btn btn-flat btn-primary"><i class='fa fa-angle-left'></i> Kembali ke Halaman Home</a>
            </div>
        </div>
    </div>
</div>
