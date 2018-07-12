<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\widgets\Menu;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> - Admin Disperindag Jatim</title>
    <?php $this->head() ?>
</head>
<body class="sidebar-mini skin-blue layout-boxed ">
<?php $this->beginBody() ?>

<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="<?= Yii::$app->request->baseUrl; ?>" class="logo">
          <span class="logo-mini"><b>A</b>D</span>
          <span class="logo-lg"><b>Admin</b>Disperindag</span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <?php if(Yii::$app->user->identity->level == 'admin'){ ?>
                <!-- Notif Agenda -->                
                <li class="dropdown messages-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-calendar-o"></i>
                      <?php 
                        $nac_not_see = count($notif_new['agenda']);
                        if($nac_not_see) echo '<span class="label label-warning">'.$nac_not_see.'</span>';
                      ?>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="header"><?= ($nac_not_see>0) ? "Ada ".$nac_not_see." agenda baru" : "Tidak agenda baru" ?></li>
                      <li <?= ($nac_not_see==0) ? 'style="height:0px;"' : '' ?>>
                        <!-- inner menu: contains the messages -->
                        <ul class="menu">
                          <?php foreach ($notif_new['agenda'] as $key => $agenda_baru) { ?>
                            <li <?= ($key%2==0) ? "style='background-color:#fbfbfb'" : "" ?>><!-- start message -->
                              <a href="<?= Yii::$app->request->baseUrl ?>/agenda/<?= $agenda_baru->id_agenda ?>">
                                <!-- Message title and timestamp -->
                                <h4>
                                  <?= $agenda_baru->pengirim ?>
                                  <?php if($agenda_baru->seen==2){ ?><label class="label pull-right label-info">Perubahan</label><?php } ?>
                                  <small><i class="fa fa-clock-o"></i> <?= $agenda_baru->tgl_posting ?></small>
                                </h4>
                                <!-- The message -->
                                <p><?= $agenda_baru->tema ?></p>
                              </a>
                            </li><!-- end message -->
                          <?php } ?>
                        </ul><!-- /.menu -->
                      </li>
                      <li class="footer"><a href="<?= Yii::$app->request->baseUrl ?>/agenda">Lihat Semua Pesan</a></li>
                    </ul>
                </li>
                <!-- End Notif Agenda -->                

                <!-- Notif Buku Tamu -->
                <li class="dropdown messages-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-envelope-o"></i>
                      <?php 
                        $nbc_not_see = count($notif_new['bukutamu']);
                        if($nbc_not_see)
                          echo '<span class="label label-warning">'.$nbc_not_see.'</span>';
                      ?>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="header"><?= ($nbc_not_see>0) ? "Anda mendapatkan ".$nbc_not_see." pesan baru" : "Tidak ada pesan baru" ?></li>
                      <li <?= ($nbc_not_see==0) ? 'style="height:0px;"' : '' ?>>
                        <!-- inner menu: contains the messages -->
                        <ul class="menu">
                          <?php foreach ($notif_new['bukutamu'] as $key => $bukutamu) { ?>
                            <li <?= ($key%2==0) ? "style='background-color:#fbfbfb'" : "" ?>><!-- start message -->
                              <a href="<?= Yii::$app->request->baseUrl ?>/buku-tamu/view?id=<?= $bukutamu->id_hubungi ?>">
                                <!-- Message title and timestamp -->
                                <h4>
                                  <?= $bukutamu->email ?>
                                  <small><i class="fa fa-clock-o"></i> <?= $bukutamu->tanggal ?></small>
                                </h4>
                                <!-- The message -->
                                <p><?= $bukutamu->subjek ?></p>
                              </a>
                            </li><!-- end message -->
                          <?php } ?>
                        </ul><!-- /.menu -->
                      </li>
                      <li class="footer"><a href="<?= Yii::$app->request->baseUrl ?>/buku-tamu">Lihat Semua Pesan</a></li>
                    </ul>
                </li>
                <!-- End Notif Buku Tamu -->

                <!-- Notif Member Mobile -->
                <li class="dropdown messages-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-user"></i>
                      <?php 
                        $nmc_not_see = count($notif_new['member']);
                        if($nmc_not_see)
                          echo '<span class="label label-warning">'.$nmc_not_see.'</span>';
                      ?>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="header"><?= ($nmc_not_see>0) ? "Pendaftar ".$nmc_not_see." member baru" : "Tidak ada member baru" ?></li>
                      <li <?= ($nmc_not_see==0) ? 'style="height:0px;"' : '' ?>>
                        <!-- inner menu: contains the messages -->
                        <ul class="menu">
                          <?php foreach ($notif_new['member'] as $key => $member) { ?>
                            <li <?= ($key%2==0) ? "style='background-color:#fbfbfb'" : "" ?>><!-- start message -->
                              <a href="<?= Yii::$app->request->baseUrl ?>/member-mobile/view?id=<?= $member->id ?>">
                                <!-- Message title and timestamp -->
                                <h4>
                                  <?= $member->nama ?>
                                  <small><i class="fa fa-clock-o"></i> <?= date("Y-m-d",$member->created_at) ?></small>
                                </h4>
                                <!-- The message -->
                                <p><?= $member->alamat ?></p>
                              </a>
                            </li><!-- end message -->
                          <?php } ?>
                        </ul><!-- /.menu -->
                      </li>
                      <li class="footer"><a href="<?= Yii::$app->request->baseUrl ?>/member-mobile">Lihat Semua Member</a></li>
                    </ul>
                </li>
                <!-- End Notif Member Mobile -->

                <!-- Notif Akun Email -->
                <li class="dropdown messages-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-user-circle"></i>
                      <?php 
                        $nec_not_see = count($notif_new['mailAccount']);
                        if($nec_not_see)
                          echo '<span class="label label-warning">'.$nec_not_see.'</span>';
                      ?>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="header"><?= ($nec_not_see>0) ? "Pendaftar ".$nec_not_see." akun email baru" : "Tidak ada akun email baru" ?></li>
                      <li <?= ($nec_not_see==0) ? 'style="height:0px;"' : '' ?>>
                        <!-- inner menu: contains the messages -->
                        <ul class="menu">
                          <?php foreach ($notif_new['mailAccount'] as $key => $member) { ?>
                            <li <?= ($key%2==0) ? "style='background-color:#fbfbfb'" : "" ?>><!-- start message -->
                              <a href="<?= Yii::$app->request->baseUrl ?>/mail-account/view?id=<?= $member->account_id ?>">
                                <!-- Message title and timestamp -->
                                <h4>
                                  <?= $member->name ?>
                                  <small><i class="fa fa-clock-o"></i> <?= date("Y-m-d",$member->created_at) ?></small>
                                </h4>
                                <!-- The message -->
                                <p><?= $member->bidang->nama ?>, <?= $member->subbag->nama ?></p>
                              </a>
                            </li><!-- end message -->
                          <?php } ?>
                        </ul><!-- /.menu -->
                      </li>
                      <li class="footer"><a href="<?= Yii::$app->request->baseUrl ?>/mail-account">Lihat Semua Akun Email</a></li>
                    </ul>
                </li>
                <!-- End Notif Akun Email -->

                <?php } ?>

                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <span class="hidden-xs"><?= Yii::$app->user->identity->username ?></span>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="user-header">
                        <p>
                          <?= Yii::$app->user->identity->username ?>
                          <small>Menjadi user admin Disperindag JATIM<br> sejak Nov. 2012</small>
                        </p>
                      </li>
                      <li class="user-footer">
                        <div class="pull-left">
                          <a href="<?= Yii::$app->request->baseUrl."/user/profile" ?>" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                            <?= Html::a('<span>Sign out</span>', ['/site/logout'], [
                                'class' => 'btn btn-default btn-flat',
                                'data' => [
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </div>
                      </li>
                    </ul>
                </li>
            </ul>
          </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar Menu -->              
            <?php
                $menuKonten = [
                    [
                        'label' => 'MENU KONTEN', 
                        'options'=>['class'=>'header']
                    ],
                    [
                        'label' => '<i class="fa fa-bullhorn"></i> <span>Post</span>', 
                        'url' => ['post/index'],
                        'active'=>Yii::$app->controller->id=='post',
                    ],
                    [
                        'label' => '<i class="fa fa-calendar-o"></i> <span>Agenda</span>', 
                        'url' => ['agenda/index'],
                        'active'=>Yii::$app->controller->id=='agenda',
                    ],
                    [
                        'label' => '<i class="fa fa-object-group"></i> <span>Galeri</span> <i class="fa fa-angle-left pull-right"></i>', 
                        'url' => ['#'],
                        'options'=> ['class'=>'treeview'],
                        'items' => [
                             [
                                'label' => '<i class="fa fa-photo fa-sm"></i> Foto', 
                                'url' => ['album-photo/index'], 
                                'active'=>Yii::$app->controller->id=='album-photo'],
                             [
                                'label' => '<i class="fa fa-video-camera fa-sm"></i> Video', 
                                'url' => ['video/index']],
                        ],
                    ],
                    [
                        'label' => '<i class="fa fa-download"></i> <span>File Download</span>', 
                        'url' => ['download/index'],
                        'active'=>Yii::$app->controller->id=='download',
                    ],
                ];

                if(Yii::$app->user->identity->level == 'admin'){ 
                  $nn_sidebar_bt = "";
                  $nn_sidebar_m = "";
                  $nn_sidebar_e = "";
                  if($nbc_not_see>0) 
                    $nn_sidebar_bt = '<small class="label pull-right bg-yellow">'.$nbc_not_see.'</small>';
                  if($nmc_not_see>0)
                    $nn_sidebar_m = '<small class="label pull-right bg-yellow">'.$nmc_not_see.'</small>';
                  if($nec_not_see>0)
                    $nn_sidebar_e = '<small class="label pull-right bg-yellow">'.$nec_not_see.'</small>';
                
                  $menuUtama = [
                      [
                          'label' => 'MENU UTAMA', 
                          'options'=>['class'=>'header']
                      ],
                      [
                          'label' => '<i class="fa fa-th-large"></i> <span>Dashboard</span>', 
                          'url' => ['site/index']
                      ],
                      [
                          'label' => '<i class="fa fa-database"></i> <span>Data Master</span> <i class="fa fa-angle-left pull-right"></i>', 
                          'url' => ['#'],
                          'options'=> ['class'=>'treeview'],
                          'items' => [
                               [
                                  'label' => '<i class="fa fa-users fa-sm"></i> Manajemen User', 
                                  'url' => ['user/index'], 
                                  'active'=>Yii::$app->controller->id=='user',
                               ],
                               [
                                  'label' => '<i class="fa fa-info-circle fa-sm"></i> Identitas Website', 
                                  'url' => ['identity/index']
                               ],
                               [
                                  'label' => '<i class="fa fa-list-ol fa-sm"></i> Kategori Post', 
                                  'url' => ['kategori-post/index'],
                                  'active'=>Yii::$app->controller->id=='kategori-post',
                               ],
                               [
                                  'label' => '<i class="fa fa-list-ol fa-sm"></i> Kategori Download', 
                                  'url' => ['kategori-download/index'],
                                  'active'=>Yii::$app->controller->id=='kategori-download',
                               ],
                               [
                                  'label' => '<i class="fa fa-tags fa-sm"></i> Tag Post (label)', 
                                  'url' => ['label/index'],
                                  'active'=>Yii::$app->controller->id=='label',
                               ],
                               // [
                               //    'label' => '<i class="fa fa-tags fa-sm"></i> Tag Post (label)', 
                               //    'url' => ['label/index'],
                               //    'active'=>Yii::$app->controller->id=='label',
                               // ],
                               [
                                  'label' => '<i class="fa fa-database fa-sm"></i> Master Industri', 
                                  'url' => ['#'],
                                  'options'=> ['class'=>'treeview'],
                                  'items' => [
                                      [
                                        'label' => '<i class="fa fa-list-ol fa-sm"></i>KBLI',
                                        'url' => ['kbli/index'],
                                        'active'=>Yii::$app->controller->id=='kbli',
                                      ],
                                      [
                                        'label' => '<i class="fa fa-list-ol fa-sm"></i>Badan Usaha',
                                        'url' => ['badan-usaha/index'],
                                        'active'=>Yii::$app->controller->id=='badan-usaha',
                                      ],
                                      [
                                        'label' => '<i class="fa fa-list-ol fa-sm"></i>Data Perindustrian',
                                        'url' => ['industri/index'],
                                        'active'=>Yii::$app->controller->id=='industri',
                                      ]
                                    ]
                                 
                               ],
                               /*[
                                  'label' => '<i class="fa fa-exclamation-triangle fa-sm"></i> Kata Sensor', 
                                  'url' => ['kata-sensor/index'],
                                  'active'=>Yii::$app->controller->id=='kata-sensor',
                                ],*/
                          ],
                      ],
                      [
                          'label' => '<i class="fa fa-flag"></i> <span>Halaman Profil</span>', 
                          'url' => ['halaman-profil/index'],
                          'active'=>Yii::$app->controller->id=='halaman-profil',
                      ],
                      [
                          'label' => '<i class="fa fa-heart-o"></i> <span>Pelayanan</span>', 
                          'url' => ['pelayanan-instansi/index'],
                          'active'=>Yii::$app->controller->id=='pelayanan-instansi',
                          /*'options'=> ['class'=>'treeview'],
                          'items' => [
                               [
                                  'label' => '<i class="fa fa-circle-o fa-sm"></i> Jenis Pelayanan', 
                                  'url' => ['jenis-pelayanan/index'], 
                                  'active'=>Yii::$app->controller->id=='jenis-pelayanan'],
                               [
                                  'label' => '<i class="fa fa-circle-o fa-sm"></i> UPT INDAG', 
                                  'url' => ['upt-indag/index'],
                                  'active'=>Yii::$app->controller->id=='upt-indag',],
                           ],*/
                      ],
                      [
                          'label' => '<i class="fa fa-briefcase"></i> <span>SAKIP</span>', 
                          'url' => ['sakip/index'],
                          'active'=>Yii::$app->controller->id=='sakip',
                      ],
                      [
                          'label' => '<i class="fa fa-text-width"></i> <span>Running Text</span>', 
                          'url' => ['running-text/index'],
                          'active'=>Yii::$app->controller->id=='running-text',
                      ],
                      [
                          'label' => '<i class="fa fa-book"></i> <span>Buku Tamu</span> '.$nn_sidebar_bt, 
                          'url' => ['buku-tamu/index'],
                          'active'=>Yii::$app->controller->id=='buku-tamu',
                      ],
                      [
                          'label' => '<i class="fa fa-user"></i> <span>Member Mobile</span> '.$nn_sidebar_m, 
                          'url' => ['member-mobile/index'],
                          'active'=>Yii::$app->controller->id=='member-mobile',
                      ],
                      [
                          'label' => '<i class="fa fa-link"></i> <span>Link Terkait</span>', 
                          'url' => ['link-terkait/index'],
                          'active'=>Yii::$app->controller->id=='link-terkait',
                      ],
                      [
                          'label' => '<i class="fa fa-wrench"></i> <span>Mail Server Setting</span>', 
                          'url' => ['mail-server/index'],
                          'active'=>Yii::$app->controller->id=='mail-server',
                      ],
					  [
                          'label' => '<i class="fa fa-feed"></i> <span>Feedback</span> ', 
                          'url' => ['feedback/index'],
                          'active'=>Yii::$app->controller->id=='feedback',
                      ],
                      [
                          'label' => 'MANAGE PEGAWAI', 
                          'options'=>['class'=>'header']
                      ],
                      [
                          'label' => '<i class="fa fa-circle-o"></i> <span>Data Unit Kerja</span>', 
                          'url' => ['unit-kerja/index'],
                      ],
                      [
                          'label' => '<i class="fa fa-user"></i> <span>Akun Email</span> '.$nn_sidebar_e, 
                          'url' => ['mail-account/index'],
                          'active'=>Yii::$app->controller->id=='mail-account',
                      ],
                      [
                          'label' => '<i class="fa fa-history"></i> <span>History File Shared</span>', 
                          'url' => ['#'],
                          'active'=>Yii::$app->controller->id=='history-shared',
                      ],
					  
                  ];
                  $menuItems = array_merge($menuUtama, $menuKonten);
                }else{
                  $menuUtama = [[
                                  'label' => '<i class="fa fa-th-large"></i> <span>Dashboard</span>', 
                                  'url' => ['site/index']
                                ]];
                  $menuItems = array_merge($menuUtama, $menuKonten);
                }

                echo Menu::widget([
                        'encodeLabels' => false,
                        'items' => $menuItems,
                        'submenuTemplate' => "\n<ul class='treeview-menu'>\n{items}\n</ul>\n",
                        'activeCssClass'=>'active',
                        'activateParents'=>true,
                        'options'=>['class'=>'sidebar-menu'],
                        'activateParents'=>true,

                    ]);
            ?>
            <br><br>
        </section>
        <!-- /.sidebar -->
    </aside>
    <div class="content-wrapper">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>   
    <footer class="main-footer">
        <div class="pull-right hidden-xs">Supported by <a href="http://mamorasoft.com" target="blank">Mamorasoft</a></div>
        <strong>&copy; <?= date('Y') ?> Disperindag Prov. Jatim.</strong> All rights reserved.
    </footer>    
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
