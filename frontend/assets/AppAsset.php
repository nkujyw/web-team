<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    
    public $css = [
        'css/bootstrap.min.css', // 1. 先加载框架基础样式 (修复轮播图错位)
        'css/animate.min.css',   // 2. 加载动画库 (可选)
        'css/site.css',         
    ];
    
    public $js = [
        'js/bootstrap.bundle.min.js', 
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
    ];
}