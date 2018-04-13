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
class ShowImageAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/../backend/web';
    public $css = [
        'plugins/lightbox/css/lightbox.min.css',
    ];
    public $js = [
        'plugins/lightbox/js/lightbox.min.js',
    ];
    public $depends = [
        'backend\assets\AppAsset',
    ];
}
