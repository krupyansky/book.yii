<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\assets;

/**
 * Класс ресурсов для модуля админки.
 *
 * @author Krupy
 */
class AdminAsset extends \yii\web\AssetBundle
{
    
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css',
        'adminlte/bower_components/font-awesome/css/font-awesome.min.css',
        'adminlte/bower_components/Ionicons/css/ionicons.min.css',
        'adminlte/dist/css/AdminLTE.min.css',
        'adminlte/dist/css/skins/skin-blue.min.css',
        '//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic',
    ];
    public $js = [
        'adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js',
        'adminlte/dist/js/adminlte.min.js',
        'js/admin.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
    
}
