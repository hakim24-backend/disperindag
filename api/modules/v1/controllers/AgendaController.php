<?php

namespace app\modules\v1\controllers;

use app\modules\v1\models\Agenda;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;

class AgendaController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\modules\v1\models\Agenda';
    
    public function actions() {
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['update']);
        unset($actions['create']);
        unset($actions['delete']);
        
        return $actions;
    }

    public function behaviors() {
        $behaviors = parent::behaviors();
                
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
        
        $agenda = Agenda::find()
                     ->orderBy(['id_agenda' => SORT_DESC]);
        
        $provider = new ActiveDataProvider([
            'query' => $agenda,
            'pagination' => [
                'pageSize' => $limit,
            ],
        ]);    
        
        return $provider;
    }
    
}
