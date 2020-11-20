<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '//fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i',
        'css/bootstrap.min.css',
        'css/font-awesome.min.css',
        'css/flaticon.css',
        'css/slicknav.min.css',
        'css/jquery-ui.min.css',
        'css/owl.carousel.min.css',
        'css/animate.css',
        'css/style.css',
    ];
    public $js = [
        'js/bootstrap.min.js',
        'js/jquery.slicknav.min.js',
        'js/owl.carousel.min.js',
        'js/jquery.nicescroll.min.js',
        'js/jquery.zoom.min.js',
        'js/jquery-ui.min.js',
        'js/maskedinput.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
