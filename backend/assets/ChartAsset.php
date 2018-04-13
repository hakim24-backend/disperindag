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
class ChartAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/../backend/web';
    public $css = [
        
    ];
    public $js = [
        'static/plugins/chartjs/chart-2.min.js',  
        'js/forchart.js',
        'static/plugins/slimScroll/jquery.slimscroll.min.js',
        'static/dist/js/pages/dashboard.js',
        'static/plugins/sparkline/jquery.sparkline.min.js',
    ];
    public $depends = [
        'backend\assets\AppAsset',
    ];
}
