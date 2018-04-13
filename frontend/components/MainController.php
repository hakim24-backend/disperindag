<?php
namespace frontend\components;

use common\models\HalamanProfil;
use common\models\KategoriPost;
use common\models\Post;
use common\models\Download;
use common\models\Visitors;
use common\models\Agenda;
use common\models\PelayananInstansi;
use common\models\Identitas;
use common\models\LinkTerkait;
use Yii;

/**
* class parent controller
*/
class MainController extends \yii\web\Controller
{
    public function init() {
      //$this->recordVisitor();
      parent::init();
    }

    /**
    * Untuk data yang selalu dipanggil disetiap halaman website
    * @param $content
    * @return mixed
    */
    public function renderContent($content)
    {
      // used identitas
      $identitas = Identitas::find()->one();

    	$menu['profile'] = HalamanProfil::find()
    					->select(['judul','slug'])
    					->all();
      $menu['pelayanan'] = PelayananInstansi::find()
              ->select(['nama','slug'])
              ->all();
      $menu['link_terkait'] = LinkTerkait::find()
              ->select(['judul','url'])
              ->where(['status_menu'=>1])
              ->all();


      $sidebar['kategori_post'] = KategoriPost::find()
                                    ->where(['aktif'=>'Y'])
                                    ->all();
      $sidebar['popular_post'] = Post::find()
                                  ->select(['judul','judul_seo','hari','jam','tanggal','gambar'])
                                  ->limit(6);
      $sidebar['download'] = Download::find()
                              ->select(['judul','nama_file'])
                              ->orderBy(['hits'=>SORT_ASC])
                              ->limit(5)
                              ->all();
      $sidebar['agenda'] = Agenda::find()
                                  ->select(['tema','tema_seo','tgl_mulai'])
                                  ->orderBy(['id_agenda'=>SORT_DESC])
                                  ->limit(4)
                                  ->all();

      if(Yii::$app->controller->id=='post' && Yii::$app->controller->action->id=='index'){
        $sidebar['popular_post'] = $sidebar['popular_post']->orderBy(['dibaca'=>SORT_DESC]);
      }else{
        $sidebar['popular_post'] = $sidebar['popular_post']->orderBy(['id_berita'=>SORT_DESC]);
      }
      $sidebar['popular_post'] = $sidebar['popular_post']->all();

      // used in footer
      $result_exchange  = $this->currencyExchange();
      //$visitors         = $this->getVisitorStatistic();

      $layoutFile = $this->findLayoutFile($this->getView());
        if ($layoutFile !== false) {
            return $this->getView()->renderFile($layoutFile, [
              'identitas'         => $identitas,
            	'content'           => $content,
            	'menu'              => $menu,
              'sidebar'           => $sidebar,
              'currency_exchange' => $result_exchange,
              //'visitors'          => $visitors,
            ], $this);
        } else {
            return $content;
        }
    }


     /**
     * Record visitor, visits
     */
    private function recordVisitor()
    {
      $cookies = Yii::$app->request->cookies;
      if($cookies->has('user_identifier')) {
        // returning visitor
        $user_identifier = $cookies['user_identifier']->value;
        // try to find if we have anything logged for today
        $model = Visitors::find()->where([
            "date"=>date("Y-m-d"), 
            "user_identifier"=>$user_identifier
        ])->one();

        if(!$model) {
        // first time today!
          $model = new Visitors;
          $model->date = date("Y-m-d");
          $model->user_identifier = $user_identifier;
          $model->visits = 1;
          $model->save();
        }
        else {
          // just adjust the count
          $model->visits++;
          $model->save();
        }

      }
      else {
        // a new visitor
        $cookies = Yii::$app->response->cookies;
        $user_identifier = md5(rand()); // a nice way to generate a random string
        $cookies->add(new \yii\web\Cookie([
            'name' => 'user_identifier',
            'value' => $user_identifier,
            'expire' => time() + 60 * 60 * 24 * 365 * 5,
        ]));
        
        // record the visit
        $model = new Visitors;
        $model->date = date("Y-m-d");
        $model->user_identifier = $user_identifier;
        $model->visits = 1;
        $model->save();
      }
    }

    /**
     * Get visitor statistik
     * @return Array
     */
    private function getVisitorStatistic()
    {
      $visitors_model = Visitors::find();
      $visitors['all'] = $visitors_model->count();
      $visitors['all_hits'] = $visitors_model->sum('visits');
      $visitors['today'] = $visitors_model->where(["date"=>date("Y-m-d")])->count();
      $visitors['today_hits'] = $visitors_model->where(["date"=>date("Y-m-d")])->sum('visits');
      return $visitors;
    }

    /**
     * Currency excahange
     * @return Array
     */
    private function currencyExchange()
    {
      $session = Yii::$app->session;
      // Currency exchange
      $to_exchange = 'USD,EUR,AUD,JPY,SGD';
      $curl_handle = curl_init();
      curl_setopt($curl_handle, CURLOPT_URL,'http://api.fixer.io/latest?base=IDR&symbols='.$to_exchange);
      curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
      curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Disperindag Jawa Timur');
      $query_exchange = curl_exec($curl_handle);
      $response_curl = curl_getinfo($curl_handle,CURLINFO_HTTP_CODE);
      curl_close($curl_handle);     
      
      if($response_curl == 200){
        $result_exchange = json_decode($query_exchange);
        foreach ($result_exchange->rates as $currency => $value) {
          $result_exchange->rates->$currency = round(1/$value);
        }
        $session->set('currency_exchange', $result_exchange);
      }else{
        $result_exchange = $session->get('currency_exchange');
      }
      return $result_exchange;
    }

    /**
    * Membuat url slug
    * @param string $text (judul dari content)
    * @return string
    */
    static public function slugify($text)
    {
      // replace non letter or digits by -
      $text = preg_replace('~[^\pL\d]+~u', '-', $text);

      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);

      // trim
      $text = trim($text, '-');

      // remove duplicate -
      $text = preg_replace('~-+~', '-', $text);

      // lowercase
      $text = strtolower($text);

      if (empty($text))
      {
        return 'n-a';
      }

      return $text;
    }

    public function makeSlug()
    {
      $model = UptIndag::find()->all();
      foreach ($model as $key => $value) {
        $item = UptIndag::findOne($value->id_halaman);
        $item->slug = $this->slugify($item->judul);
        $item->save();
      }
    }
}