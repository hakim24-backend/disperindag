<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    //'bootstrap' => ['log','MenuClass'],
    'bootstrap' => ['log','userCounter'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'userCounter' => [
            'class' => 'app\components\UserCounter',
            'tableUsers' => 'pcounter_users',
            'tableSave' => 'pcounter_save',
            'autoInstallTables' => true,
            'onlineTime' => 10, // min
        ],
        /*'MenuClass'=>[
            'class'=>'frontend\components\MenuClass',
         ],*/
        'assetManager' => [
            'basePath' => '@webroot/frontend/web/assets/',
            'baseUrl' => '@web/frontend/web/assets/',
        ],
        /*'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],*/
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
		'i18n' => [
            'translations' => [
                'sourceLanguage' => 'en-En',
                 
                'polls*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@yii/vendor/lslsoft/poll/messages',
                ],
                 
            ],
        ],
        
    ],
    'params' => $params,
];
