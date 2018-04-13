<?php

/* @var $this yii\web\View */
//use backend\assets\ChartAsset;

//ChartAsset::register($this);

$this->title = 'Dashboard';
?>

<section class="content-header">
  <h1>
    <?= $this->title ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li class="active"><i class="fa fa-th-large"></i> Dashboard</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    
    <!-- =========================================================== -->

          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-sign-in"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Kunjungan</span>
                  <span class="info-box-number"><?= number_format($count['kunjungan']) ?></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                  <span class="progress-description">
                    
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-male"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Pengunjung</span>
                  <span class="info-box-number"><?= number_format($count['pengunjung']) ?></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                  <span class="progress-description">
                    
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-pencil"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Post</span>
                  <span class="info-box-number"><?= number_format($count['post']) ?></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                  <span class="progress-description">
                    
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-mobile"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Member Mobile Apps</span>
                  <span class="info-box-number"><?= number_format($count['member']) ?></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                  <span class="progress-description">
                    
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- =========================================================== -->
<!--
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Statistik Pengunjung Website</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body chart-responsive">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="input-group">
                                <span class="input-group-addon">Tahun</span>
                                <select class="form-control" id="range-tahun">
                                    <option value="0">Semua Tahun</option>
                                    <?php 
                                        $thisYear = date("Y");
                                        for($year=$thisYear; $year>$thisYear-5; $year--){
                                            if($year == $thisYear)
                                                echo "<option selected value='".$year."'>".$year."</option>";
                                            else
                                                echo "<option value='".$year."'>".$year."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">Bulan</span>
                                <select class="form-control" id="range-bulan">
                                    <option value="0">Semua Bulan</option>
                                    <?php 
                                        $thisMonth = date("n");
                                        for ($i=1; $i <= 12; $i++) { 
                                            $month = date("F",strtotime("1-".$i."-".$thisYear));
                                            if($thisMonth==$i)
                                                echo "<option value='".$i."' selected>".$month."</option>";
                                            else
                                                echo "<option value='".$i."'>".$month."</option>";
                                        }
                                    ?>    
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" id="btn-update-statistik" onclick="updateStatistik($('#range-tahun').val(),$('#range-bulan').val())" class="btn btn-primary btn-flat btn-block">Lihat Statistik</button>
                        </div>
                    </div>
                    <hr>
                    <div class="chart" id="graph-container">
                        <canvas id="lineChart" height="100px"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
-->

    <div class="row">
        <?php if(Yii::$app->user->identity->level=='admin'){ ?>
        <div class="col-md-7">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Buku Tamu</h3>
                  <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body thumb-dashboard buku-tamu">
                    <ul class="timeline">
                        <?php foreach ($list['bukutamu'] as $bukutamu) { ?>
                        <li>
                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> <?= $bukutamu->tanggal ?></span>
                                <h3 class="timeline-header"><a href="<?= Yii::$app->request->baseUrl ?>/buku-tamu/view?id=<?= $bukutamu->id_hubungi ?>"><?= $bukutamu->email ?></a></h3>
                                <div class="timeline-body">
                                  <label><?= $bukutamu->subjek ?></label><br>
                                  <?= $bukutamu->getStringThumb($bukutamu->pesan,200) ?>
                                </div>
                                <div class="timeline-footer">
                                    <a href="<?= Yii::$app->request->baseUrl ?>/buku-tamu/view?id=<?= $bukutamu->id_hubungi ?>" class="btn btn-default btn-flat btn-sm">Lihat Detail</a>
                                </div>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="box-footer text-center">
                  <a href="<?= Yii::$app->request->baseUrl ?>/buku-tamu" class="uppercase">Lihat Semua Buku Tamu</a>
                </div><!-- /.box-footer -->
            </div><!-- /.box (chat box) -->
        </div>
        <?php } ?>
        <div class="<?= (Yii::$app->user->identity->level=='admin') ? 'col-md-5' : 'col-md-4' ?>">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Post Berita</h3>
                  <div class="box-tools pull-right">
                    <a href="<?= Yii::$app->request->baseUrl ?>/post/create" class="btn btn-default btn-flat btn-sm"><i class="fa fa-plus"></i> Tambah Baru</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body thumb-dashboard">
                  <ul class="products-list product-list-in-box">
                    <?php foreach ($list['post'] as $post) { 
                        $image = Yii::$app->request->baseUrl."/..".Yii::$app->params['uploadUrlPost']."/thumb_mobile/small_".$post->gambar;
                    ?>
                    <li class="item">
                      <div class="product-img">
                        <img src="<?= $image ?>" />
                      </div>
                      <div class="product-info">
                        <a href="<?= Yii::$app->request->baseUrl ?>/post/<?= $post->id_berita ?>" class="product-title">
                          <?= $post->getStringThumb($post->judul,30) ?> 
                          <span class="label label-primary pull-right"><i class="fa fa-eye"></i> <?= $post->dibaca ?></span>
                        </a>
                        <span class="product-description">
                          <?= $post->getStringThumb($post->isi_berita,100) ?>
                        </span>
                      </div>
                    </li><!-- /.item -->
                    <?php } ?>
                  </ul>
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="<?= Yii::$app->request->baseUrl ?>/post" class="uppercase">Lihat Semua Post Berita</a>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
        </div>
        
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agenda</h3>
                  <div class="box-tools pull-right">
                    <a href="<?= Yii::$app->request->baseUrl ?>/agenda/create" class="btn btn-default btn-flat btn-sm"><i class="fa fa-plus"></i> Tambah Baru</a>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body thumb-dashboard agenda">
                  <ul class="todo-list">
                    <?php foreach ($list['agenda'] as $agenda) { ?>
                    <li>
                        <div style="width:90px;display:block;font-size:12px;margin-bottom:2px;" class="label label-primary label-flat">
                          <i class="fa fa-calendar-o fa-sm"></i> <?= $agenda->tgl_mulai ?>
                        </div>
                        <a href="<?= Yii::$app->request->baseUrl ?>/agenda/<?= $agenda->id_agenda ?>"><span class="text"><?= $agenda->tema ?></span></a>
                    </li>
                    <?php } ?>
                  </ul>
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="<?= Yii::$app->request->baseUrl ?>/agenda" class="uppercase">Lihat Semua Agenda</a>
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
        </div>
        <?php if(Yii::$app->user->identity->level=='admin'){ ?>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Members Mobile</h3>
                  <div class="box-tools pull-right">
                    <?= ($count['member_baru']>0) ? '<span class="label label-primary">'.$count['member_baru'].' Member Baru</span>' : ''; ?>
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body thumb-dashboard member">
                  <ul class="products-list product-list-in-box">
                    <?php
                      foreach ($list['member'] as $key => $member) { ?>
                      <?php 
                        if($member->seen==0) { 
                          echo '<li class="item" style="background-color: #eee">'; 
                        }else{
                          echo '<li class="item">';
                        }
                      ?>
                      <div class="product-info">
                        <a href="<?= Yii::$app->request->baseUrl ?>/member-mobile/view?id=<?= $member->id ?>" class="product-title"><?= $member->nama ?> <span class="label label-success pull-right">2016-04-09</span></a>
                        <span class="product-description">
                          <?= $member->email ?>
                        </span>
                      </div>
                    </li><!-- /.item -->
                    <?php 
                      }
                    ?>
                  </ul>
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="<?= Yii::$app->request->baseUrl ?>/member-mobile" class="uppercase">Lihat Semua Member</a>
                </div><!-- /.box-footer -->
            </div><!--/.box -->
        </div>
        <?php } ?>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">File Download</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body thumb-dashboard agenda">
                  <ul class="todo-list">
                    <?php foreach ($list['download'] as $download ) { ?>
                    <li>
                        
                        
                            <div class="row">
                              <div class="col-xs-3 text-center">
                                <div class="btn btn-primary btn-xs btn-flat"><i class="fa fa-download"></i> <?= $download->hits ?></div>
                              </div>
                              <div class="col-xs-9">
                                <a target="_blank" href="<?= Yii::$app->request->baseUrl .'/'. $download->getPath().$download->nama_file ?>">
                                  <?= $download->judul ?>
                                </a>
                              </div>
                            </div>
                        
                    </li>
                    <?php } ?>
                  </ul>
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="<?= Yii::$app->request->baseUrl ?>/download" class="uppercase">Lihat Semua File Download</a>
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
        </div>
    </div>
    
</section><!-- /.content -->