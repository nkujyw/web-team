<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    // 【重点修改】CSS 加载顺序
    public $css = [
        'css/bootstrap.min.css', // 1. 先加载框架基础样式 (修复轮播图错位)
        'css/animate.min.css',   // 2. 加载动画库 (可选)
        'css/site.css',          // 3. 最后加载你的自定义样式 (确保红色背景生效)
    ];
    
    public $js = [
        'js/bootstrap.bundle.min.js', // 之前让你加的 JS
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap4\BootstrapAsset', // 再次确认：这行要注释掉，因为我们手动加载了 bootstrap.min.css
    ];
}