<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use scotthuangzl\googlechart\GoogleChart;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = "Detail Post";
$urlPreview = "/../post/detail?content=";

$this->registerJs("

window.onload  = function () {
    var message = [];
    var socket = io.connect('http://prayuga.com:49634');
    var button = document.getElementById('button_notif_berita');

    socket.on('disperindag:BeritaBaru', function(data){
        tampilkanBerita(data);
    });
    
    var detailBerita = {
                    id: 303,
                    judul: 'Ini adalah berita baru sekali 33',
                    deskripsi: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy',
            gambar_url: 'http://us.images.detik.com/content/2014/09/15/230/dplagidalem.jpg',
                };

   if(button != null){
        button.onclick = function() {
            var r = confirm('Broadcast suatu berita dibatasi 1 kali sehari, apakah Anda yakin ingin membroadcast berita ini sekarang?');
            if(r==true){
                $.ajax({
                    url: '".Yii::$app->request->baseUrl."/post/broadcast-to-firebase?id=".$model->id_berita."',
                    type: 'post',
                    beforeSend: function(){
                        $('#button_notif_berita').button('loading');
                    },                 
                    success: function(detailBerita2){
                        $('#button_notif_berita').button('reset');
                        var hasil = JSON.parse(detailBerita2);
                        console.log(hasil);
                        socket.emit('beritaDitambahkan', hasil);  
                        location.reload();
                    }
                });
            }
        }
    }
};


function tampilkanBerita(berita) {
    console.log(berita);
}

");

?>
<script src="<?= Yii::$app->request->baseUrl ?>/../disperind-socket/socket.io-1.4.5.js"></script>
<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="index"><i class="fa fa-bullhorn"></i> Post</a></li>
    <li class="active">Detail</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-header">
                <?= Html::a('Update', ['update', 'id' => $model->id_berita], ['class' => 'btn btn-flat btn-primary']) ?>
                <?= Html::a('Hapus', ['delete', 'id' => $model->id_berita], [
                    'class' => 'btn btn-flat btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>

                <span class=" preview-website">
                    <?php 
                        if(Yii::$app->user->identity->level == 'admin'){
                            if($model->headline == 'N'){
                                echo Html::a('Jadikan Headline', ['headline', 'id' => $model->id_berita], [
                                    'class' => 'btn btn-flat btn-success button_notif_berita',
                                    'data' => [
                                        'confirm' => 'Apakah Anda yakin menjadikan berita ini sebagai headline di halaman home? Headline berita dibatasi 5 berita, ter-urut dari berita dengan posting terbaru.',
                                        'method' => 'post',
                                    ],
                                ]);
                            }

                            if($model->headline == 'Y'){
                                echo Html::a('Hapus dari Headline', ['headline', 'id' => $model->id_berita], [
                                    'class' => 'btn btn-flat btn-warning',
                                    'data' => [
                                        'confirm' => 'Berita ini hanya akan dihapus dari headline di halaman home, apakah Anda yakin?',
                                        'method' => 'post',
                                    ],
                                ]);
                            }

                            if($model->status_broadcast == 0){
                                echo " ";
                                
                                ?>
                                <a data-loading-text="Loading..." class="btn btn-flat btn-info" id="button_notif_berita">Broadcast ke Mobile</a>
                                <?php 
                            }
                        }
                        ?>
                    <a href="<?= Yii::$app->request->baseUrl.$urlPreview.$model->judul_seo ?>" class="btn btn-flat btn-default" target="blank">Lihat berita ini di website</a>
                </span>
          <div class="pull-right box-tools"><a href="index" class="btn btn-sm btn-default btn-flat">Kembali</a></div>
        </div>

   

<div class="box-body">
            <div class="single-page">
                <div class="notif">
                    <?php 
                        if($model->headline == 'Y'){ 
                            echo '<label class="label label-success">Dijadikan Headline</label>';
                        } 
                        echo " ";
                        if($model->status_broadcast == 1){
                            echo '<label class="label label-info">Hari ini telah dibroadcast</label>';
                        }
                    ?>
                </div>
                <div class="judul"><?= $model->judul ?></div>
                <div class="info">
                    Diposting oleh <?= $model->username ?> pada <?= $model->tanggal ?><br>
                    Tags : <?= $model->tag ?> 
                </div>
                <div class="imageThumb"><img src="<?= Yii::$app->request->baseUrl ?>/..<?= Yii::$app->params['uploadUrlPost'] ?><?= $model->gambar ?>"></div>
                <div class="article"><?= $model->isi_berita ?></div>
            </div>
            <div class="col-md-12">
              <div class="box-body" style="position:relative;left: 22%;">

                <?php
                echo GoogleChart::widget(array('visualization' => 'PieChart',
                        'data' => array(
                            array('Komentar', 'Total Polling'),
                            array('Sangat Bagus', (int)$pollSangatBagus),
                            array('Bagus', (int)$pollBagus),
                            array('Biasa Saja', (int)$pollBiasaSaja),
                            array('Kurang Bagus',(int)$pollKurangBagus)
                        ),
                        'options' =>
                          ['width'=>'600','height'=>'400','title'=>'Diagram lingkaran Polling Berita','left'=>'23%']));
                ?>

              </div>
            </div>
            
        </div>
    </div>
</section>