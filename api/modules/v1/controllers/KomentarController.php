<?php

namespace app\modules\v1\controllers;

use app\modules\v1\models\Komentar;

class KomentarController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\modules\v1\models\Komentar';
    
    public function actions() {
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['create']);
        unset($actions['destroy']);
        unset($actions['view']);
        return $actions;
    }
    
    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['verbs'] = [
            'class' => \yii\filters\VerbFilter::className(),
            'actions' => [
                'index'     => ['get'],
                'create'    => ['post'],
                'edit'      => ['post'],
                'destroy'   => ['delete'],
                'view'      => ['get'],
            ],
        ];
        $behaviors['authenticator'] = [
            'class' => \yii\filters\auth\HttpBearerAuth::className()
        ];
        return $behaviors; 
    }
    
    public function actionIndex($id_berita = false) {
        if(!$id_berita) {
            throw new \yii\web\NotFoundHttpException('Halaman yang anda cari tidak ditemukan !', 404);
            return;
        }
        
        $komentar = Komentar::find()
                        ->where(['=', 'id_berita', $id_berita])
                        ->orderBy('id_komentar DESC');
        
        $provider = new \yii\data\ActiveDataProvider([
            'query' => $komentar,
            'pagination' => [
                'pageSize' => 20
            ],
        ]);
        
        return $provider;
    }
    
    public function actionCreate($id_berita = false) {
        $berita = \app\modules\v1\models\Berita::findOne(['id_berita' => $id_berita]);
        if(!$id_berita || !$berita) {
            throw new \yii\web\NotFoundHttpException('Halaman yang anda cari tidak ditemukan !', 404);
            return;
        }
        
        $komentar = new \app\modules\v1\models\Komentar();
        $input = \Yii::$app->request->post();
        $userKey = \Yii::$app->user->identity->getAuthKey();
        $user = \app\modules\v1\models\MemberMobile::findIdentityByAccessToken($userKey);
        
        $komentar->id_berita = $id_berita;
        $komentar->tanggal = date('Y-m-d');
        $komentar->jam = date('H:i:s');
        $komentar->isi_komentar = $input['isi_komentar'];
        $komentar->id_member_mobile = $user->getId();
        
        if(!$komentar->validate()) {
            return ['error' => true, 'message' => 'Isikan data dengan benar !'];
        }
        
        if($komentar->save())
            return ['error' => false, 'message' => 'Komentar berhasil dikirim !'];
        else
            return ['error' => true, 'message' => 'Komentar tidak dapat dikirim !'];
    }
    
    public function actionEdit($id_komentar = false) {
        
        $input = \Yii::$app->request->post();
        $komentar = Komentar::findOne(['id_komentar' => $id_komentar]);
        $userKey = \Yii::$app->user->identity->getAuthKey();
        $user = \app\modules\v1\models\MemberMobile::findIdentityByAccessToken($userKey);
        
        if(!$komentar || $komentar->id_member_mobile != $user->getId()) {
            throw new \yii\web\NotFoundHttpException('Halaman yang anda cari tidak ditemukan !', 404);
            return;
        }
        
        $komentar->tanggal = date('Y-m-d');
        $komentar->jam = date('H:i:s');
        $komentar->isi_komentar = $input['isi_komentar'];
        
        if(!$komentar->validate()) {
            return ['error' => false, 'message' => 'Isikan data dengan benar !'];
        }
        
        if($komentar->save())
            return ['error' => false, 'message' => 'Komentar berhasil diubah !'];
        else
            return ['error' => true, 'message' => 'Komentar tidak dapat diubah !'];
    }
    
    public function actionView($id_komentar = false) {
        $komentar = Komentar::findOne(['id_komentar' => $id_komentar]);
        if(!$komentar) {
            throw new \yii\web\NotFoundHttpException('Halaman yang anda cari tidak ditemukan !', 404);
            return;
        }
        
        return $komentar;
    }
    
    public function actionDestroy($id_komentar = false) {
        $komentar = Komentar::findOne(['id_komentar' => $id_komentar]);
        $userKey = \Yii::$app->user->identity->getAuthKey();
        $user = \app\modules\v1\models\MemberMobile::findIdentityByAccessToken($userKey);
        
        if(!$komentar || $komentar->id_member_mobile != $user->getId()) {
            throw new \yii\web\NotFoundHttpException('Halaman yang anda cari tidak ditemukan !', 404);
            return;
        }
        
        if($komentar->delete())
            return ['error' => false, 'message' => 'Komentar dihapus !'];
        else
            return ['error' => true, 'message' => 'Komentar gagal dihapus !'];
    }
}
