<?php

namespace frontend\controllers;

use Yii;
use frontend\components\MainController;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

class PasarController extends MainController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
