<?php

namespace frontend\controllers;

use Yii;
use frontend\components\MainController;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use common\models\Industri;

class DirektoriIndustriController extends MainController
{
    public function actionIndex()
    {
        $model = Industri::find()->all();

        return $this->render('index',[
        	'model'=>$model
        ]);
    }

}
