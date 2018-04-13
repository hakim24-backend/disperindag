<?php 
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
?>

<div id="top-of-footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="box">
                    <div class="title"></div>
                </div>
            </div>
            <div class="col-sm-3"></div>
            <div class="col-sm-3"></div>
            <div class="col-sm-3"></div>
        </div>
    </div>
</div>

<div class="footer">
    <div class="container">
        <div class="col-md-4">
            <div class="box">
                <div class="title">Hubungi Kami</div>
                <div class="content hubungi-kami">
                    <div class="text1">Disperindag Provinsi Jawa Timur</div>
                    <div class="text2">Jl. Siwalankerto Utara II/42 Surabaya 60236</div>
                    <div class="text3"><b>Telp : </b> 031-8499895</div>
                    <div class="text4"><b>Fax : </b> 031-8431717</div>
					<div class="text4"><b>Email : </b> disperindag@jatimprov.go.id</div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="box">
                <div class="title">Nilai Tukar Rupiah</div>
                <div class="content tukar-rupiah">
                    <table class="table">
                        <?php 
                        if(isset($currency_exchange)){
                            foreach ($currency_exchange->rates as $currency => $value) { 
                                echo '<tr>';
                                echo '<td width="75">1 '.$currency.'</td>';
                                echo '<td width="1">=</td>';
                                echo '<td>Rp '.number_format($value, 0, ',', '.').'</td>';
                                echo '</tr>';
                            }
                        }
                        
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="box">
                <div class="title">Statistik Pengunjung</div>
                <div class="content statistik">
                    <table class="table">
                        <tr>
                            <td width="150">Pengunjung Hari Ini</td>
                            <td width="1">:</td>
                            <td><?php echo Yii::$app->userCounter->getToday(); ?></td>
                        </tr>
                        <tr>
                            <td>Total Pengunjung</td>
                            <td>:</td>
                            <td><?php echo Yii::$app->userCounter->getTotal(); ?></td>
                        </tr>
                        <tr>
                            <td>Hits Hari Ini</td>
                            <td>:</td>
                            <td><?php echo Yii::$app->userCounter->getHitsToday(); ?></td>
                        </tr>
                        <tr>
                            <td>Total Hits</td>
                            <td>:</td>
                            <td><?php echo Yii::$app->userCounter->getHitsTotal(); ?></td>
                        </tr>
                        <tr>
                            <td>Pengunjung Online</td>
                            <td>:</td>
                            <td><?php echo Yii::$app->userCounter->getOnline(); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>


<div class="copyright">
    <div class="container">
        <p>&copy; <?= date('Y',time()) ?> Dinas Perindustrian dan Perdagangan Provinsi Jawa Timur.<br> All Rights Reserved</p>
    </div>
</div>