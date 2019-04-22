<?php

/* @var $this yii\web\View */
?>
<style type="text/css">
#instafeed img {
  width: 33%;
}
</style>

<div id="carousel-slider" class="carousel slide" data-ride="carousel">
    
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <?php foreach ($model_banner as $key => $banner) { ?>

        <div class="item <?= ($key==0) ? 'active' : '' ?>" style="background-image: url(
                <?= Yii::$app->request->baseUrl ?>/common/uploaded/post/<?= str_replace(' ','%20',$banner->gambar) ?>)">
            <div class="blank"></div>
            <div class="carousel-caption">
                <h3><a href="<?= Yii::$app->request->baseUrl ?>/post/detail?content=<?= $banner->judul_seo ?>"><?= $banner->judul ?></a></h3>
                <?= $banner->getStringThumb($banner->isi_berita,140) ?>
                <br><br>
                <a href="<?= Yii::$app->request->baseUrl ?>/post/detail?content=<?= $banner->judul_seo ?>" class="btn btn-default btn-flat btn-sm">Baca Selengkapnya</a>
            </div>
        </div>
        <?php } ?>
    </div>

      <!-- Controls  -->
    <a class="left carousel-control" href="#carousel-slider" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-slider" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
        
<div class="running-text-wrap">
    <div class="container">
        <div class="row">
        <div class="icon col-xs-2">
            <div><span class="fa fa-exclamation"></span></div>
        </div>
        <div class="running-text col-xs-10">
            
            <div id="aniHolder">
                <?php 
                foreach ($running_text as $key => $text) {
                    echo "<div>".$text->info."</div>";
                }
                ?>
            </div>
            
            <style type="text/css">
                #aniHolder div {display:none;}
            </style>

        </div>
        </div>
    </div>
</div>

<div class="container" style="padding-top: 20px;">
    
    <div class="row home-content">
       
        <div class="col-md-6">
            <div id="body-content">

                <div class="news-new-wrap">
                    <div class="box-content">
                        <div class="box-header">
                            <h3 class="title">Berita Terbaru</h3>
                        </div>
                        <div class="box-body">
                            

                                <?php foreach ($list_post as $key => $post) { ?>
                                
                                    <div class="news-new">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <a href="<?= Yii::$app->request->baseUrl ?>/post/detail?content=<?= $post->judul_seo ?>">
                                                <div class="image-thumb" style="background-image: url(<?= Yii::$app->request->baseUrl.Yii::$app->params['uploadUrlPost']."thumb/medium_".str_replace(' ','%20',$post->gambar) ?>);">
                                                <div class="blank"></div>
                                                </div>
                                                </a>
                                            </div>
                                            <div class="col-xs-8 content-news-new">
                                                <div class="title"><a href="<?= Yii::$app->request->baseUrl ?>/post/detail?content=<?= $post->judul_seo ?>"><?= $post->judul ?></a></div>
                                                <div class="info">Berita | <?= $post->hari." ".$post->tanggal." ".$post->jam ?></div>
                                                <p><?= $post->getStringThumb($post->isi_berita,180) ?></p>
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?>
                                <div class="read-more"><a href="<?= Yii::$app->request->baseUrl ?>/post">Lihat Berita Lainnya</a></div>
                            
                        </div>
                    </div>
                    </div>
                
            </div>
        </div>
         <div class="col-md-3">
            <div class="sidebar-content">
                <div class="row">
                    <div class="col-md-12 col-sm-6">
                        <div class="box-content popular-news">
                            <div class="box-header">
                                <h3 class="title">Berita Populer</h3>
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
                        <div class="box-content agenda-sidebar">
                            <div class="box-header">
                                <h3 class="title">Twitter
                                    <span class="pull-right">
                                        <a href="<?= Yii::$app->request->baseUrl ?>/agenda"><i class="fa fa-plus"></i></a>
                                    </span>
                                </h3>
                            </div>
                            <div class="box-body" style="max-height:358px;overflow:auto;">
                                <a class="twitter-timeline" href="https://twitter.com/INDAG_JATIM">Tweets by TwitterDev</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                            </div>
                        </div>
                    </div>
					<div class="col-md-12 col-sm-6">
                        <div class="box-content agenda-sidebar">
                            <div class="box-header">
                                <h3 class="title">Instagram
                                    <span class="pull-right">
                                        <a href="<?= Yii::$app->request->baseUrl ?>/agenda"><i class="fa fa-plus"></i></a>
                                    </span>
                                </h3>
                            </div>
                            <div class="box-body" style="max-height:358px;overflow:auto;">
								
                                <?php
									 $config = Yii::$app->instafeedConfig;
									  // var_dump($config);die();
									  echo \nirvana\instafeed\Instafeed::widget([
										'pluginOptions' => [
										  'get' => 'user',
										  'userId'=>'7215683654',
										  'clientId' => $config->clientId,
										  'accessToken' => $config->accessToken,
										  'limit'=>9,
										  'template' => '<a href="{{link}}" target="_blank" id="{{id}}"><img src="{{image}}" /></a>',
										],
									  ]);
									?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="sidebar-content">
                <div class="row"> 
                    <div class="col-md-12 col-sm-6">
                        <div class="box-content">
                            <div class="box-header">
                                <h3 class="title">Video Terbaru
                                    <span class="pull-right">
                                        <a href="<?= Yii::$app->request->baseUrl ?>/gallery/video"><i class="fa fa-plus"></i></a>
                                    </span>
                                </h3>
                            </div>
                            <div class="box-body">
                                <iframe width="100%" height="220px" src="https://www.youtube.com/embed/<?= $model_video->getIdYoutubeVideo() ?>" frameborder="0" allowfullscreen></iframe>
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
                    <div class="col-md-12 col-sm-6">
                        <div class="box-content">
                            <div class="box-header">
                                <h3 class="title">Peta Lokasi
                                    <span class="pull-right">
                                        <a target="blank" href="https://www.google.co.id/maps/place/Dinas+Perindustrian+Dan+Perdagangan/@-7.338434,112.7030213,13z/data=!4m8!1m2!2m1!1sDinas+Perindustrian+dan+Perdagangan+Jawa+Timur+Jalan+Siwalankerto+Tengah+No.109,+Siwalankerto,+Wonocolo,+Kota+Surabaya,+Jawa+Timur,+Indonesia!3m4!1s0x2dd7fb4683373e8b:0x3fbda74f4b37a886!8m2!3d-7.3348586!4d112.7334054?hl=en"><i class="fa fa-plus"></i></a>
                                    </span>
                                </h3>
                            </div>
                            <div class="box-body">
                                <script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script>
                                <div style='overflow:hidden;height:auto;width:100%;'>
                                    <div id='gmap_canvas' style='height:300px;width:100%;'></div>
                                    <style>
                                        #gmap_canvas img{max-width:none!important;background:none!important}
                                    </style>
                                </div>
                                <script type='text/javascript'>function init_map(){var myOptions = {zoom:15,center:new google.maps.LatLng(-7.33709033604949,112.73408255908205),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(-7.33709033604949,112.73408255908205)});infowindow = new google.maps.InfoWindow({content:'<strong>Dinas Perindustrian dan Perdagangan Jawa Timur</strong><br>Jalan Siwalankerto Tengah No.109, Siwalankerto, Wonocolo, Kota Surabaya, Jawa Timur, Indonesia<br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
                            </div>
                        </div>
                    </div>
					<div class="col-md-12 col-sm-6">
                        <div class="box-content">
                            <div class="box-header">
                                <h3 class="title">Cuaca Hari Ini</h3>
                            </div>
                            <div class="box-body" style="max-height:358px;overflow:auto;" ng-app="myapp" ng-controller="WeatherCtrl">
                                <weather-icon cloudiness="{{ weather.clouds }}"></weather-icon>
                                <h3 style="padding-top: 5px">Suhu Hari ini: {{ weather.temp.current | temp:2 }}</h3>
                                min: {{ weather.temp.min | temp }}
                                <br>
                                max: {{ weather.temp.max | temp }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 <!-- link terkait -->
<div id="owl-caro">
    <div class="container">
        <h3 class="title"><strong>Link Terkait</strong></h3><hr>
        <div class="owl-carousel owl-theme">
        <?php foreach ($list_link_terkait as $key => $value) { ?>
            
                <div class="item"><a href="<?=$value->url?>" target="blank" title="<?=$value->url?>">
                    <img src="/disperindagproject/common/uploaded/other/<?=$value->gambar?>" class="img-responsive" ></a>
                </div>
                
        <?php } ?>
                <!-- width: 300px;
                   height: 170px;
                -->
        </div>
    </div>
</div>



<script type="text/javascript" src="https://code.angularjs.org/1.1.4/angular.js"></script>
<script type="text/javascript">
    'use strict';

    var myapp = angular.module('myapp', []);

    myapp.factory('weatherService', function($http) {
        return { 
          getWeather: function() {
            var weather = { temp: {}, clouds: null };
            $http.jsonp('http://api.openweathermap.org/data/2.5/weather?q=Surabaya,id&units=metric&callback=JSON_CALLBACK&APPID=f9dbd911bc01df1d9ce563b2ba4d3209').success(function(data) {
                if (data) {
                    if (data.main) {
                        weather.temp.current = data.main.temp;
                        weather.temp.min = data.main.temp_min;
                        weather.temp.max = data.main.temp_max;
                    }
                    weather.clouds = data.clouds ? data.clouds.all : undefined;
                }
            });

            return weather;
          }
        }; 
    });

    myapp.filter('temp', function($filter) {
        return function(input, precision) {
            if (!precision) {
                precision = 1;
            }
            var numberFilter = $filter('number');
            return numberFilter(input, precision) + '\u00B0C';
        };
    });

    myapp.controller('WeatherCtrl', function ($scope, weatherService) {
        $scope.weather = weatherService.getWeather();
    });

    myapp.directive('weatherIcon', function() {
        return {
            restrict: 'E', replace: true,
            scope: {
                cloudiness: '@'
            },
            controller: function($scope) {
                $scope.imgurl = function() {
                    var baseUrl = 'https://ssl.gstatic.com/onebox/weather/128/';
                    if ($scope.cloudiness < 20) {
                        return baseUrl + 'sunny.png';
                    } else if ($scope.cloudiness < 90) {
                       return baseUrl + 'partly_cloudy.png';
                    } else {
                        return baseUrl + 'cloudy.png';
                    }
                };
            },
            template: '<div style="float:left"><img ng-src="{{ imgurl() }}"></div>'
        };
    });
</script>