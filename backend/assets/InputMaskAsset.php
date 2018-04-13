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
class InputMaskAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/../backend/web';
    public $css = [
        'static/plugins/datepicker/datepicker3.css',
        'static/plugins/timepicker/bootstrap-timepicker.min.css',
    ];
    public $js = [
        'static/plugins/datepicker/bootstrap-datepicker.js',
        'static/plugins/timepicker/bootstrap-timepicker.min.js',
        'static/plugins/input-mask/jquery.inputmask.js',
        'static/plugins/input-mask/jquery.inputmask.date.extensions.js',
        'static/plugins/input-mask/jquery.inputmask.extensions.js',
        'js/inputmask.js',
    ];
    public $depends = [
        'backend\assets\AppAsset',
    ];
}
