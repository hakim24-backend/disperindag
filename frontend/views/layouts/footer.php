<?php 
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use elzix\CurrencyConverter\CurrencyConverter;


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
// $converter = new CurrencyConverter();
// $ratea =  $converter->convert('c222ff3fe93847068b127563a3fa8cf4', 'USD', 'NPR'); // Use Single Currency Code
// $ratec =  $converter->convert('c222ff3fe93847068b127563a3fa8cf4', 'NPR', 'IDR'); // Use Single Country Code

// print_r($ratea);  // it will print current Nepalese currency (NPR) rate according to USD
// print_r($ratec);  // it will print current Nepalese (NP) currency rate according to US
// $response =  json_decode(file_get_contents('http://kurs.dropsugar.com/rates/bca.json'));
// echo "Terakhir diupdate pada: " . date('j-m-Y H:i:s');
// foreach ($response->kurs as $currency => $value) {
//     echo 'Nilai jual ' . $currency . ' adalah: ' . $value->jual . '<br>';
//     echo 'Nilai beli ' . $currency . ' adalah: ' . $value->beli . '<br><br>';
// }     
                        $json = file_get_contents('http://www.adisurya.net/kurs-bca/get');
                        $my_array = json_decode($json);
                       
                        ?>
                        <tr>
                            <td width="40">USD</td>
                            <td width="20">Rp <?= number_format($my_array->Data->USD->Jual,2,",",".") ?></td>
                            <td width="20">Rp <?= number_format($my_array->Data->USD->Beli,2,",",".") ?></td>
                        </tr>

                        <tr>
                            <td width="40">EUR</td>
                            <td width="20">Rp <?= number_format($my_array->Data->EUR->Jual,2,",",".") ?></td>
                            <td width="20">Rp <?= number_format($my_array->Data->EUR->Beli,2,",",".") ?></td>
                        </tr>

                        <tr>
                            <td width="40">AUD</td>
                            <td width="20">Rp <?= number_format($my_array->Data->AUD->Jual,2,",",".") ?></td>
                            <td width="20">Rp <?= number_format($my_array->Data->AUD->Beli,2,",",".") ?></td>
                        </tr>

                        <tr>
                            <td width="40">JPY</td>
                            <td width="20">Rp <?= number_format($my_array->Data->JPY->Jual,2,",",".") ?></td>
                            <td width="20">Rp <?= number_format($my_array->Data->JPY->Beli,2,",",".") ?></td>
                        </tr>

                        <tr>
                            <td width="40">SGD</td>
                            <td width="20">Rp <?= number_format($my_array->Data->SGD->Jual,2,",",".") ?></td>
                            <td width="20">Rp <?= number_format($my_array->Data->SGD->Beli,2,",",".") ?></td>
                        </tr>
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