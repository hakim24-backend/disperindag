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
class PortalAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/../backend/web';
    public $css = [
        'static/bootstrap/css/bootstrap.min.css',
        '../../common/assets/icons/font-awesome-4.7.0/css/font-awesome.min.css',
        'static/dist/css/AdminLTE.min.css',
        'static/plugins/iCheck/square/blue.css',
        'css/custom.css',
        'css/portal.css',
    ];
    public $js = [
        'static/bootstrap/js/bootstrap.min.js',
        'static/plugins/iCheck/icheck.min.js',
        'js/portal.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
