<?php

namespace app\modules\v1\controllers;

use app\modules\v1\models\Berita;
use app\modules\v1\models\Kategori;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;

class BeritaController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\modules\v1\models\Berita';
      
    public function actions() {
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['update']);
        unset($actions['create']);
        unset($actions['delete']);
        unset($actions['view']);
        
        return $actions;
    }
    
    public function behaviors() {
        $behaviors = parent::behaviors();
        
        $behaviors['verbs'] = [
            'class' => \yii\filters\VerbFilter::className(),
            'actions' => [
                'index' => ['get'],
                'view'  => ['get'],
            ],
        ];
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className()
        ];
        return $behaviors;
    }
    
    public function actionIndex() {
        $params = $_REQUEST;
        $filter = array();
        $sort   = "";
        
        $limit  = \Yii::$app->params['jumlah_per_halaman'];
        
        if(isset($params['filter'])) $filter = (array) json_decode ($params['filter']);
        
        $berita = Berita::find()
                    ->joinWith(
                        [Kategori::tableName() => function($query) {
                            $query->andWhere(['=', 'kategori.aktif', Kategori::KATEGORI_AKTIF]);
                        }]
                    )->where(['=', 'berita.id_kategori', 22])
                     ->orderBy(['berita.id_berita' => SORT_DESC]);
        
        if(isset($filter['judul'])) {
            $berita = $berita->andWhere(['LIKE', 'judul', $filter['judul']]);
        }
        
        $provider = new ActiveDataProvider([
            'query' => $berita,
            'pagination' => [
                'pageSize' => $limit,
            ],
        ]);    
        
        return $provider;
    }
    
    public function actionView($id) {
        $berita = Berita::find()->joinWith("komentar")
                           ->select(['berita.*', 'count(komentar_mobile.id_komentar) as jumlah_komentar'])
                           ->where(['=', 'berita.id_berita', $id])
                           ->one();
        $b      = [
            'berita_id'     => $berita['id_berita'],
            'berita_judul'  => $berita['judul'],
            'berita_author' => $berita['username'],
            'berita_judul_seo' => $berita['judul_seo'],
            'berita_kategori'  => $berita['kategori'],
            'berita_tanggal'   => $berita['tanggal'],
            'berita_hari'      => $berita['hari'],
            'berita_jam'       => $berita['jam'],
            'berita_tag'       => $berita['tag'],
            'berita_detail'    => $berita['isi_berita'],
            'berita_headline'  => $berita['headline'],
            'berita_gambar_url' => $berita['gambar'],
            'berita_jumlah_komentar' => count($berita['komentar'])
        ];
        
        return $b;
    }
    
    public function actionTerkait($id) {
        $berita = Berita::find()->where(["id_berita" => $id])->one();
        
        $sql = \Yii::$app->db->createCommand("
                    SELECT id_berita, judul, hari, tanggal, jam, MATCH(judul, isi_berita) AGAINST('".addslashes($berita->judul)."') AS score
                    FROM berita 
                    WHERE MATCH(judul, isi_berita) AGAINST('".addslashes($berita->judul)."') AND 
                    judul NOT IN ('".addslashes($berita->judul)."') AND id_kategori = '22'
                    ORDER BY score DESC LIMIT 6
                ");
        $related = $sql->queryAll();
        
        return $related;
    }
}
