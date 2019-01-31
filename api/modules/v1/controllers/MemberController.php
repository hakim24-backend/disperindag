<?php

namespace app\modules\v1\controllers;

use app\modules\v1\models\SignupForm;
use app\modules\v1\models\LoginForm;

class MemberController extends \yii\rest\ActiveController
{
    
    public $modelClass = 'app\modules\v1\models\MemberMobile';
    
    public function actions() {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['index']);
        unset($actions['update']);
        
        return $actions;
    }
    
    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['verbs'] = [
            'class' => \yii\filters\VerbFilter::className(),
            'actions' => [
                'register'          => ['post'],
                'login'             => ['post'],
                'profil'            => ['get'],
                'edit'              => ['post'],
                'ganti-password'     => ['post'],
            ],
        ];
        $behaviors['authenticator'] = [
            'class' => \yii\filters\auth\HttpBearerAuth::className(),
            'only'  => ['profil', 'edit', 'ganti-password','update-token'],
        ];
        
        return $behaviors;
    }
    
    public function actionRegister() {
        $model = new SignupForm();
        
        $post = \Yii::$app->request->post();
        
        $model->nama    = $post['nama'];
        $model->no_telp = $post['no_telp'];
        $model->alamat  = $post['alamat'];
        $model->gender  = $post['gender'];
        $model->email   = $post['email'];
        $model->password = $post['email'];
        $model->tanggal_lahir = $post['tanggal_lahir'];
        $model->instansi = $post['instansi'];
        
        $model->signup();
        
        return $model;
    }
    
    public function actionLogin() {
        $model = new LoginForm();
        $model->email = \Yii::$app->request->post('email');
        $model->password = \Yii::$app->request->post('password');
        
        if($model->login()) {
            return ['status' => true, 'access_token' => \Yii::$app->user->identity->getAuthKey(), 'member_id' => \Yii::$app->user->identity->getId()];
        }else{
            return ['status' => false, 'message' => 'Email dan password tidak cocok !'];
        }
    }
    
    public function actionEdit() {
        $key = \Yii::$app->user->identity->getAuthKey();
        $user = \app\modules\v1\models\MemberMobile::findIdentityByAccessToken($key);
        
        $input = \Yii::$app->request->post();
        
        $user->nama         = $input['nama'];
        $user->instansi     = $input['instansi'];
        $user->no_telp      = $input['no_telp'];
        $user->alamat       = $input['alamat'];
        
        if($user->save()) {
            return ["error" => false, "message" => "Data berhasil diupdate !"];
        }else{
            return ["error" => true, "message" => "Gagal menyimpan data !"];
        }
    }

    public function actionUpdateToken() {
        $key = \Yii::$app->user->identity->getAuthKey();
        $user = \app\modules\v1\models\MemberMobile::findIdentityByAccessToken($key);
        
        $input = \Yii::$app->request->post();
        
        $user->broadcast_token = $input['broadcast_token'];
        
        if($user->save()) {
            return ["error" => false, "message" => "Data berhasil diupdate !"];
        }else{
            return ["error" => true, "message" => "Gagal menyimpan data !"];
        }
    }
    
    public function actionProfil() {
        $key = \Yii::$app->user->identity->getAuthKey();
        return \app\modules\v1\models\MemberMobile::findIdentityByAccessToken($key);
    }
    
    public function actionGantiPassword() {
        $key = \Yii::$app->user->identity->getAuthKey();
        $user = \app\modules\v1\models\MemberMobile::findIdentityByAccessToken($key);
        $input = \Yii::$app->request->post();
        
        if(!isset($input['password_lama']) && !isset($input['password_baru']) && !isset($input['konfirmasi_password']))
            return ['error' =>  true, 'message' => 'Data tidak valid !'];
        
        if($input['password_baru'] != $input['konfirmasi_password']) {
            return ['error' => true, 'message' => 'Konfirmasi password tidak cocok !'];
        }
        
        if(!$user->validatePassword($input['password_lama'])) {
            return ['error' => true, 'message' => 'Password tidak cocok !'];
        }
        
        $user->setPassword($input['konfirmasi_password']);
        if($user->save())
            return ['error' => false, 'message' => 'Password berhasil diubah !'];
        else
            return ['error' => true, 'message' => 'Password gagal diubah !'];
    }
    
}
