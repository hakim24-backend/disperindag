<?php 
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

?>

<!-- Code provided by Google -->

<script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'id', includedLanguages: 'en,jw',layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
  }
</script>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>

<div class="header">
    <div class="header-top">
        <div class="container">
            <div class="col-md-8 logo">    
                <div class="img"><img src="<?= Yii::$app->request->baseUrl ?>/frontend/web/images/logo.png"></div>
                <div class="text">
                    <div class="text1">Dinas Perindustrian Dan Perdagangan</div>
                    <div class="text2">Provinsi Jawa Timur</div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="col-md-3 right-head">
                <div  class="gtranslate" id="google_translate_element"></div>
                    <div class="search">
                        <form method="get" action="<?= Yii::$app->request->baseUrl ?>/post/pencarian">
                            <input type="text" name="s" value="Pencarian Berita" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Pencarian Berita';}">
                            <input type="submit" value="">
                        </form>
                    </div>  
            </div>
            <div>
            <div id="google_translate_element"></div>
                
            </div>    
        </div>
    </div>
    <div class="head-bottom head-bottom-normal">
        <div class="container">
            <?php

                if(count($menu['profile']) > 0){
                    foreach ($menu['profile'] as $item) {
                        $view_menu_profile[] = [
                            'label' => $item->judul, 
                            'url' => ['/profile/about?content='.$item->slug]
                        ];                                   
                    }
                    $menu_profile = [
                        'label' => 'Profil', 'url' => ['#'],
                        'active'=>Yii::$app->controller->id=='profile',
                        'options'=> ['class'=>'treeview'],
                        'items' => $view_menu_profile,
                    ];
                }else{
                    $menu_profile = ['label' => 'Profil', 'url' => ['/profile/index']];
                }

                if(count($menu['pelayanan']) > 0){
                    foreach ($menu['pelayanan'] as $item) {
                        $view_menu_pelayanan[] = [
                            'label' => $item->nama, 
                            'url' => ['/pelayanan/about?content='.$item->slug]
                        ];                                   
                    }
                    $menu_pelayanan = [
                        'label' => 'Pelayanan', 'url' => ['#'],
                        'active'=>Yii::$app->controller->id=='pelayanan',
                        'options'=> ['class'=>'treeview'],
                        'items' => $view_menu_pelayanan,
                    ];
                }else{
                    $menu_pelayanan = ['label' => 'Pelayanan', 'url' => ['/pelayanan/index']];
                }

                
                // if(count($menu['link_terkait']) > 0){
                //     foreach ($menu['link_terkait'] as $item) {
                //         $view_menu_link_terkait[] = [
                //             'label' => $item->judul,
                //             'url' => $item->url, 
                //             'linkOptions'=>['target'=>'blank']
                //         ];
                //     }

                //     $view_menu_link_terkait[] = [  
                //        'label'=>'Lihat Semua',
                //        'options'=> ['class'=>'not-active'],
                //        'url'=>['/interaktif/link-terkait'],
                //     ];

                //     $menu_link_terkait = [
                //         'label' => 'Link Terkait', 'url' => ['/interaktif/link-terkait'],
                //         'items'=> $view_menu_link_terkait,
                //     ];                        
                // }else{
                //     $menu_link_terkait = ['label' => 'Link Terkait', 'url' => ['/interaktif/link-terkait']];
                // }


                NavBar::begin([
                    'options' => [
                        'class' => 'navbar-wrap',
                    ],
                ]);
                $menuItems = [
                    ['label' => 'Home', 'url' => ['/'], 'active'=>Yii::$app->controller->id=='site'],
                    $menu_profile,
                    //$menu_pelayanan,
                    ['label' => 'Berita', 'url' => ['/post'], 'active'=>Yii::$app->controller->id=='berita'],
                    ['label' => 'Sakip', 'url' => ['/sakip'], 'active'=>Yii::$app->controller->id=='sakip'],
                    ['label' => 'Buku Tamu', 'url' => ['/interaktif/contact']],
                    // $menu_link_terkait,
                    ['label' => 'Galeri', 'url' => ['#'],
                        'active'=>Yii::$app->controller->id=='gallery',
                        'options'=> ['class'=>'treeview'],
                        'items' => [
                             [
                                'label' => 'Foto', 'url' => ['/gallery/photo-album'], 
                                'active'=>Yii::$app->controller->action->id=='photo-album',
                                'active'=>Yii::$app->controller->action->id=='photos',
                            ],
                            [
                                'label' => 'Video', 'url' => ['/gallery/video'], 
                                'active'=>Yii::$app->controller->action->id=='video',
                            ],
                            [   'label' => 'Download', 'url' => ['/download'], 
                                'active'=>Yii::$app->controller->id=='download'
                            ],
                        ],
                    ],

                    // ['label' => 'Download', 'url' => ['/download'], 'active'=>Yii::$app->controller->id=='download'],
                    //['label' => 'Intranet', 'url' => null, 'linkOptions'=>['href'=>'http://disperindag.jatimprov.go.id/intranet/', 'target'=>'blank']],
                    //['label' => 'SIM IKM', 'url' => null, 'linkOptions'=>['href'=>'http://disperindag.jatimprov.go.id/sim_ikm/', 'target'=>'blank']],
                    ['label' => 'PPID', 'url' => null, 'linkOptions'=>['href'=>'http://disperindag.jatimprov.go.id/dp/', 'target'=>'blank']],
                    ['label' => 'Informasi Harga Pasar', 'url' => ['/pasar']],
                    ['label' => 'Feedback', 'url' => ['interaktif/feedback']],
                    // ['label' => 'Industri', 'url' => ['interaktif/industri']],
                ];
                echo Nav::widget([
                    'encodeLabels' => false,
                    'options' => ['class' => 'navbar-nav'],
                    'items' => $menuItems,
                ]);
                NavBar::end();
            ?>
        </div>
    </div>
    <div class="head-bottom head-bottom-fixed">
        <div class="container">
            <?php
                NavBar::begin([
                    'options' => [
                        'class' => 'navbar-wrap',
                    ],
                ]);
                echo Nav::widget([
                    'encodeLabels' => false,
                    'options' => ['class' => 'navbar-nav'],
                    'items' => $menuItems,
                ]);
                NavBar::end();
            ?>
        </div>
    </div>
</div>  

   
<!--Start of Tawk.to Script-->


<!-- <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5a685b61d7591465c7070b81/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();

</script> -->
<!--End of Tawk.to Script-->

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5bc98108460a125f2656b908/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->