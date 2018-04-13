<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\SingleAppAsset;
use common\widgets\Alert;

SingleAppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title)." - ".$identitas->nama_website ?></title>
    <meta name="description" content="<?= $identitas->meta_deskripsi ?>">
    <meta name="keywords" content="<?= $identitas->meta_keyword ?>">
    <link rel="shortcut icon" href="<?= Yii::$app->request->baseUrl.Yii::$app->params['uploadUrlOther'].$identitas->favicon ?>" />
    <meta name="author" content="rahmatheruka and thefiqroh">
    <?php $this->head() ?>
    <script type="text/javascript">var switchTo5x=true;</script>
</head>
<body>


<?php $this->beginBody() ?>


<div class="wrap">
    <?= 
        $this->render("header",[
            'menu'=>$menu,
        ]); 
    ?>

    <div class="container" style="padding-top: 20px;">
        <div class="row main-content">
            <div class="col-md-9">
                <div id="body-content">

                    <?= $content ?>
                    
                </div>
            </div>
            <div class="col-md-3">
                <div class="sidebar-content">
                    <div class="row"> 
                        <div class="col-md-12 col-sm-6">
                            <div class="box-content popular-news">
                                <div class="box-header">
                                    <h3 class="title">Berita <?= (Yii::$app->controller->id=='post' && Yii::$app->controller->action->id=='index') ? "Terpopuler" : "Terbaru" ?></h3>
                                </div>
                                <div class="box-body">
                                    <ul>
                                        <?php foreach ($sidebar['popular_post'] as $key => $post) { 

                                            if($key==0){
                                                echo '<li class="first-sidenews">';
                                                echo '<a href="'. Yii::$app->request->baseUrl .'/post/detail?content='. $post->judul_seo.'">';
                                                echo '
                                                        <div class="image-thumb" style="background-image: url('. Yii::$app->request->baseUrl.Yii::$app->params['uploadUrlPost']."thumb/medium_".str_replace(' ','%20',$post->gambar) .');"></div>
                                                        <div class="title">'.$post->judul.'</div>
                                                        <div class="info">'.$post->hari.", ".$post->tanggal.' '.$post->jam.' WIB</div>
                                                    </a></li>';
                                                continue;
                                            }
                                        ?>

                                        <li><a href="<?= Yii::$app->request->baseUrl ?>/post/detail?content=<?= $post->judul_seo ?>">
                                            <div class="media">
                                              <div class="media-left" style="background-image: url(<?= Yii::$app->request->baseUrl.Yii::$app->params['uploadUrlPost']."thumb_mobile/small_".str_replace(' ','%20',$post->gambar) ?>);">
                                              </div>
                                              <div class="media-body">
                                                <div class="title"><?= $post->judul ?></div>
                                                <div class="content"><?= $post->getStringThumb($post->isi_berita,100) ?>...</div>
                                              </div>
                                            </div>
                                        </a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6">
                            <div class="box-content agenda-sidebar">
                                <div class="box-header">
                                    <h3 class="title">Agenda
                                        <span class="pull-right">
                                            <a href="<?= Yii::$app->request->baseUrl ?>/agenda"><i class="fa fa-plus"></i></a>
                                        </span>
                                    </h3>
                                </div>
                                <div class="box-body">
                                    <ul>
                                        <?php foreach ($sidebar['agenda'] as $key => $agenda) { ?>
                                        <li><a href="<?= Yii::$app->request->baseUrl ?>/agenda/detail?content=<?= $agenda->tema_seo ?>" style="text-transform: ">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <div class="date-box">
                                                        <div class="tanggal"><?= date("d",strtotime($agenda->tgl_mulai)) ?></div>
                                                        <div class="bulan"><?= date("M",strtotime($agenda->tgl_mulai)) ?></div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-9">
                                                    <span class="title"><?= $agenda->tema ?></span>
                                                </div>
                                            </div>
                                        </a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6">
                            <div class="box-content">
                                <div class="box-header">
                                    <h3 class="title">Download
                                        <span class="pull-right">
                                            <a href="<?= Yii::$app->request->baseUrl ?>/download"><i class="fa fa-plus"></i></a>
                                        </span>
                                    </h3>
                                </div>
                                <div class="box-body">
                                    <ul>
                                        <?php 
                                        if(isset($sidebar['download'])){
                                            foreach ($sidebar['download'] as $key => $value) {
                                                echo '<li><a href="'. Yii::$app->request->baseUrl ?>/download/download?file=<?= $value->nama_file .'"><span class="title">'.$value['judul'].'</span></a></li>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>

<?= 
    $this->render("footer",[
        //'visitors'=>$visitors,
        'currency_exchange'=>$currency_exchange,
    ]); 
?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
