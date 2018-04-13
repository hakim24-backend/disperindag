<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/../backend/web';
    public $css = [
        'static/bootstrap/css/bootstrap.min.css',
        '../../common/assets/icons/font-awesome-4.7.0/css/font-awesome.min.css',
        '../../common/assets/icons/ionicons/css/ionicons.min.css',
        'static/dist/css/AdminLTE.min.css',
        'static/dist/css/skins/_all-skins.min.css',
        'css/main.css',
        'css/custom.css',
    ];
    public $js = [
        'static/bootstrap/js/bootstrap.min.js',
        'static/dist/js/app.min.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
