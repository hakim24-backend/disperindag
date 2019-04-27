<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class SingleAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/frontend/web';
    public $css = [
        '../../common/assets/icons/font-awesome-4.6.1/css/font-awesome.min.css',
        '../../common/assets/plugins/datatables/jquery.dataTables.min.css',
        'plugins/lightbox/css/lightbox.min.css',
        'static/css/style.css',
        'css/main.css',
        'css/site.css',
        'css/single.css',
        'css/custom.css',
        'css/responsive.css',
    ];
    public $js = [
        '../../common/assets/plugins/datatables/jquery.dataTables.min.js',
        '../../common/assets/plugins/datatables/dataTables.bootstrap.min.js',
        'plugins/lightbox/js/lightbox.min.js',
        'js/dist/jquery.marquee.js',
        'js/script.js',
        'assets/registerJs.js',
        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
