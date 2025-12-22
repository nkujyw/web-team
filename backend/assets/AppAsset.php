<?php
/**
 * AppAsset.php
 * 后台资源包，管理 CSS 和 JS 文件的引入
 */
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
        'yii\web\YiiAsset', 
    ];
}