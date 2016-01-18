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
    public $baseUrl = '@web';
    public $css = [
        'css/jquery.sidr.dark.css',
        'css/style.css',
        'font-awesome/css/font-awesome.min.css',
        'css/custom.css'
    ];
    public $js = [
        'js/jquery.sidr.min.js',
        'js/bootstrap.min.js',
        'js/jquery.validate.min.js',
        'js/jquery-validate.bootstrap-tooltip.min.js',
        'js/common.js',
        'js/utility.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
