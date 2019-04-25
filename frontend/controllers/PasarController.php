<?php

namespace frontend\controllers;

use Yii;
use frontend\components\MainController;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

class PasarController extends MainController
{
    // public function actionIndex()
    // {

    // 	//data kota
    // 	$dataArrayKabupaten = array();
    // 	$item = array();
    // 	$result = array();
    // 	$dataKabupaten = file_get_contents('http://siskaperbapo.com/api/?username=pihpsapi&password=xxhargapanganxx&task=getMasterKabkota');
    //     $dataArrayKabupaten = json_decode($dataKabupaten,true);

    //    	if ($dataArrayKabupaten['success']) {
    // 		foreach ($dataArrayKabupaten['result'] as $key => $value) {
    // 			$result[$value['kabkota_id']]=$value['kabkota_name'];
    // 		}
    // 	}

    // 	//data pangan
    // 	$dataPasar = file_get_contents('http://siskaperbapo.com/api/?username=pihpsapi&password=xxhargapanganxx&task=getMasterMarket');
    //     $dataArrayPasar = json_decode($dataPasar,true);

    //     $masterComodity = file_get_contents('http://siskaperbapo.com/api/?username=pihpsapi&password=xxhargapanganxx&task=getMasterCommodity');
    //     $masterArrayComodity = json_decode($masterComodity,true);

    // 	$dataComodity = file_get_contents('http://siskaperbapo.com/api/?username=pihpsapi&password=xxhargapanganxx&task=getDailyPriceAllMarket&tanggal='.date('Y-m-d'));
    //     $arrayComodityFinal = json_decode($dataComodity,true);

    //   $dataComodityYesterday = file_get_contents('http://siskaperbapo.com/api/?username=pihpsapi&password=xxhargapanganxx&task=getDailyPriceAllMarket&tanggal='.date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d')))));
    //     $arrayComodityFinalYesterday = json_decode($dataComodityYesterday,true);


    //     $itemToday = $this->getArrayBarang($arrayComodityFinal, $dataArrayPasar, $masterArrayComodity);

    //     $itemYesterday = $this->getArrayBarang($arrayComodityFinalYesterday, $dataArrayPasar, $masterArrayComodity);

    //     // $exists_array    = array();
    //     // foreach( $arrayComodityFinal['result'] as $element ) {

    //     //   //get market name
    //     //   $market_id = $element['market_id'];
    //     //   $market_name = array_values(array_filter($dataArrayPasar['result'], function($element) use($market_id){
    //     //     return isset($element['market_id']) && $element['market_id'] == $market_id;
    //     //     }));

    //     //   foreach( $element['details'] as $keys => $values ) {
    //     //     //get item name
    //     //     $commodity_id = $values['commodity_id'];
    //     //     $commodity_name = array_values(array_filter($masterArrayComodity['result'], function($element) use($commodity_id){
    //     //       return isset($element['commodity_id']) && $element['commodity_id'] == $commodity_id;
    //     //     }));

    //     //     //start data
    //     //     $item[$values['commodity_id']]['commodity_id'] = $values['commodity_id'];
    //     //     $item[$values['commodity_id']]['commodity_name'] = $commodity_name[0]["commodity_name"];
    //     //     $item[$values['commodity_id']]['commodity_unit'] = $commodity_name[0]["commodity_unit"];
    //     //     $item[$values['commodity_id']]['market'][$element['market_id']]['market_id'] = $element['market_id'];
    //     //     $item[$values['commodity_id']]['market'][$element['market_id']]['market_name'] = $market_name[0]['market_name'];
    //     //     $item[$values['commodity_id']]['market'][$element['market_id']]['price'] = $values['price'];
    //     //     if( !in_array( $values['commodity_id'], $exists_array )) {
    //     //         $exists_array[]    = $values['commodity_id'];
    //     //     }
    //     //     else{
    //     //       $item[$values['commodity_id']]['market'][$element['market_id']]['market_id'] = $element['market_id'];
    //     //       $item[$values['commodity_id']]['market'][$element['market_id']]['market_name'] = $market_name[0]['market_name'];
    //     //       $item[$values['commodity_id']]['market'][$element['market_id']]['price'] = $values['price'];
    //     //     }  
    //     //   }
    //     // }

    //     // var_dump($itemToday);die;

    //     $text = "";
    //     foreach ($itemToday as $key => $value) {
    //       $text .=$value['commodity_name']. " Harga rata-rata ";
    //       $hargaToday = 0;
    //       $total = count($value['market']);
    //       foreach ($value['market'] as $keys => $values) {
    //         $hargaToday+=intval($values['price']);
    //       }

    //       foreach ($itemYesterday as $keyItem => $valueItem) {
    //         if ($value['commodity_id']==$valueItem['commodity_id']) {
    //           $hargaYesterday = 0;
    //           foreach ($itemYesterday[$key]['market'] as $keyYesterday => $valueYesterday) {
    //             $hargaYesterday+=intval($valueYesterday['price']);
    //           }
    //           goto end;
    //         }
    //       }
    //       end:
    //       if ($hargaYesterday!=0 && $hargaYesterday>$hargaToday) {
    //         $text.='Rp. '.number_format(intval($hargaToday/$total),2,',','.')." -  ";
    //       }else{
    //         $text.='Rp. '.number_format(intval($hargaToday/$total),2,',','.')." +  ";
    //       }
    //       $hargaToday=0;
    //     }

    //     $this->view->params['customParam'] = 'customValue';
    //     // $this->view->params['balance'] = $text;



    //     // return $this->render('index',[
    //     // 	'kabupaten' => $result,
    //     // 	'item' => $item,
    //     // ]);
    // }


    public function getArrayBarang(array $arrayComodityFinal, array $dataArrayPasar, array $masterArrayComodity){
      $exists_array    = array();
      $item    = array();
      foreach( $arrayComodityFinal['result'] as $element ) {

        //get market name
        $market_id = $element['market_id'];
        $market_name = array_values(array_filter($dataArrayPasar['result'], function($element) use($market_id){
          return isset($element['market_id']) && $element['market_id'] == $market_id;
          }));

        foreach( $element['details'] as $keys => $values ) {
          //get item name
          $commodity_id = $values['commodity_id'];
          $commodity_name = array_values(array_filter($masterArrayComodity['result'], function($element) use($commodity_id){
            return isset($element['commodity_id']) && $element['commodity_id'] == $commodity_id;
          }));

          //start data
          $item[$values['commodity_id']]['commodity_id'] = $values['commodity_id'];
          $item[$values['commodity_id']]['commodity_name'] = $commodity_name[0]["commodity_name"];
          $item[$values['commodity_id']]['commodity_unit'] = $commodity_name[0]["commodity_unit"];
          $item[$values['commodity_id']]['market'][$element['market_id']]['market_id'] = $element['market_id'];
          $item[$values['commodity_id']]['market'][$element['market_id']]['market_name'] = $market_name[0]['market_name'];
          $item[$values['commodity_id']]['market'][$element['market_id']]['price'] = $values['price'];
          if( !in_array( $values['commodity_id'], $exists_array )) {
              $exists_array[]    = $values['commodity_id'];
          }
          else{
            $item[$values['commodity_id']]['market'][$element['market_id']]['market_id'] = $element['market_id'];
            $item[$values['commodity_id']]['market'][$element['market_id']]['market_name'] = $market_name[0]['market_name'];
            $item[$values['commodity_id']]['market'][$element['market_id']]['price'] = $values['price'];
          }  
        }
      }

      return array_values($item);
    }

    public function actionPasar($kota_id)
    {
      $item = array();
      // try{
        $arrayComodityFinal = array();
        $dataPasar = file_get_contents('http://siskaperbapo.com/api/?username=pihpsapi&password=xxhargapanganxx&task=getMasterMarket');
        $dataArrayPasar = json_decode($dataPasar,true);


        $pasarKota = array_filter($dataArrayPasar['result'], function($element) use($kota_id){
          return isset($element['kabkota_id']) && $element['kabkota_id'] == $kota_id;
        });

        $masterComodity = file_get_contents('http://siskaperbapo.com/api/?username=pihpsapi&password=xxhargapanganxx&task=getMasterCommodity');
        $masterArrayComodity = json_decode($masterComodity,true);


        $dataComodity = file_get_contents('http://siskaperbapo.com/api/?username=pihpsapi&password=xxhargapanganxx&task=getDailyPriceAllMarket&tanggal='.date('Y-m-d'));
        $dataArrayComodity = json_decode($dataComodity,true);

        //get data comodity last
        $dateNow = date('Y-m-d');
        $arrayComodityFinal = $this->comodity($dataArrayComodity,$pasarKota,$dateNow,$kota_id);

        $exists_array    = array();
        foreach( $arrayComodityFinal as $element ) {
          //get market name
          $market_id = $element['market_id'];
          $market_name = array_values(array_filter($dataArrayPasar['result'], function($element) use($market_id){
            return isset($element['market_id']) && $element['market_id'] == $market_id;
            }));

          foreach( $element['details'] as $keys => $values ) {
            //get item name
            $commodity_id = $values['commodity_id'];
            $commodity_name = array_values(array_filter($masterArrayComodity['result'], function($element) use($commodity_id){
              return isset($element['commodity_id']) && $element['commodity_id'] == $commodity_id;
            }));

            //start data
            $item[$values['commodity_id']]['commodity_id'] = $values['commodity_id'];
            $item[$values['commodity_id']]['commodity_name'] = $commodity_name[0]["commodity_name"];
            $item[$values['commodity_id']]['commodity_unit'] = $commodity_name[0]["commodity_unit"];
            $item[$values['commodity_id']]['market'][$element['market_id']]['market_id'] = $element['market_id'];
            $item[$values['commodity_id']]['market'][$element['market_id']]['market_name'] = $market_name[0]['market_name'];
            $item[$values['commodity_id']]['market'][$element['market_id']]['price'] = $values['price'];
            if( !in_array( $values['commodity_id'], $exists_array )) {
                $exists_array[]    = $values['commodity_id'];
            }
            else{
              $item[$values['commodity_id']]['market'][$element['market_id']]['market_id'] = $element['market_id'];
              $item[$values['commodity_id']]['market'][$element['market_id']]['market_name'] = $market_name[0]['market_name'];
              $item[$values['commodity_id']]['market'][$element['market_id']]['price'] = $values['price'];
            }  
          }
            
        }
      // }catch (\Exception $e) {
      //   return $e->getMessage();
      // }
	  return $this->renderAjax('filter',[
	    	'item' => $item,
	    ]);
    }

    public function comodity(array $dataArrayComodity, array $pasarKota, $dates, $kota_id)
    {
      $filtered = array();

      foreach($pasarKota as $key => $value){
        $filtered[] = array_filter($dataArrayComodity['result'], function($element) use($value){
          return isset($element['market_id']) && $element['market_id'] == $value['market_id'];
        });
      }

      if ($filtered) {
        $no=0;
        foreach($filtered as $values){
            foreach($values as $key => $valuesnew){
                $arrayComodityFinal[$no] = $valuesnew;
                $no++;
            }
        }
        return $arrayComodityFinal;
      }else{
        $datesNew = date('Y-m-d', strtotime('-1 day', strtotime($dates)));
        $dataComodity = file_get_contents('http://siskaperbapo.com/api/?username=pihpsapi&password=xxhargapanganxx&task=getDailyPriceAllMarket&tanggal='.$datesNew);
        $dataArrayComodity = json_decode($dataComodity,true);

        $dataPasar = file_get_contents('http://siskaperbapo.com/api/?username=pihpsapi&password=xxhargapanganxx&task=getMasterMarket');
        $dataArrayPasar = json_decode($dataPasar,true);

        $pasarKota = array_filter($dataArrayPasar['result'], function($element) use($kota_id){
          return isset($element['kabkota_id']) && $element['kabkota_id'] == $kota_id;
        });

        $this->comodity($dataArrayComodity, $pasarKota, $datesNew,$kota_id);

      }
    }

}
