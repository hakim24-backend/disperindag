<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Agenda */

$this->title = "Detail Agenda";


$this->registerJs("
window.onload  = function () {
    var message = [];
    var socket = io.connect('http://93.188.162.59:3700');
    var button = document.getElementById('button_notif_agenda');

    socket.on('disperindag:BeritaBaru', function(data){
        tampilkanBerita(data);
    });
    
    if(button != null){
        button.onclick = function() {
            var r = confirm('Broadcast suatu agenda dibatasi 1 kali sehari, apakah Anda yakin ingin membroadcast agenda ini sekarang?');
            if(r==true){
                $.ajax({
                    url: '".Yii::$app->request->baseUrl."/agenda/broadcast-notif?id=".$model->id_agenda."',
                    type: 'post',
                    beforeSend: function(){
                        $('#button_notif_agenda').button('loading');
                    },                 
                    success: function(detailBerita2){
                        $('#button_notif_agenda').button('reset');
                        var hasil = JSON.parse(detailBerita2);
                        console.log(hasil);
                        socket.emit('agendaDitambahkan', hasil);  
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
        <li><a href="index"><i class="fa fa-calendar-o"></i> Agenda</a></li>
        <li class="active">Detail</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-header">

            <?= Html::a('Update', ['update', 'id' => $model->id_agenda], ['class' => 'btn btn-flat btn-primary']) ?>
            <?= Html::a('Hapus', ['delete', 'id' => $model->id_agenda], [
                'class' => 'btn btn-flat btn-danger',
                'data' => [
                    'confirm' => 'Apakah Anda yakin ingin menghapus agenda "'.$model->tema.'" ?',
                    'method' => 'post',
                ],
            ]) ?>
            <span class=" preview-website">
                    <?php 
                        if(Yii::$app->user->identity->level == 'admin'){
                            if($model->status_broadcast == 0){
                                ?><a class="btn btn-flat btn-info" id="button_notif_agenda">Broadcast ke Mobile</a><?php 
                            }else{
                                echo "<label class='label label-info'>Hari ini telah dibroadcast</label>";
                            }
                        }
                        ?>
                </span>
            <div class="pull-right box-tools"><a href="index" class="btn btn-sm btn-default btn-flat">Kembali</a></div>
        </div>
        <div class="box-body">
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tgl_posting',
            'pengirim',
            'username',
            'tema',
            [
                'attribute'=>'isi_agenda',
                'format'=>'raw',
            ],
            'tgl_mulai',
            'tgl_selesai',
            'tempat',
            'jam',
        ],
    ]) ?>

        </div>
    </div>
</section>