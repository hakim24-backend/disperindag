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
class TextareaAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/../backend/web';
    public $css = [
        'css/customTinymce.css',
        'static/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'
    ];
    public $js = [
        'plugins/wysiwyg/tinymce/js/tinymce.min.js',
        'static/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
        'js/forTextarea.js'
    ];
    public $depends = [
        'backend\assets\AppAsset',
    ];
}
