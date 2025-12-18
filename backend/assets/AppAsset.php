<?php

namespace backend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    // 修改 CSS 引入路径
    public $css = [
        'adminkit/css/app.css', 
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap',
        'css/custom.css'
    ];
    
    // 修改 JS 引入路径
    public $js = [
        'adminkit/js/app.js',
    ];
    
    public $depends = [
        'yii\web\YiiAsset', // 保留这个，Yii的核心JS依赖
        // 'yii\bootstrap\BootstrapAsset', // 注释掉这个！防止旧版Bootstrap与AdminKit冲突
    ];
}