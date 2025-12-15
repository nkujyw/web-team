<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
    <style>
        body { font-family: "Microsoft YaHei", sans-serif; background-color: #f8f8f8; margin: 0; padding: 0; }
        
        /* 1. 顶部 Header 区域 (模仿参考图) */
        .site-header {
            background-color: #B71C1C; /* 深红底色 */
            background-image: linear-gradient(to bottom, #cc2e2e, #a61b1b); /* 微弱的质感渐变 */
            padding: 25px 0;
            text-align: center;
            border-bottom: 4px solid #FFD700; /* 金色底边 */
        }
        
        .site-title-text {
            font-family: "KaiTi", "STKaiti", serif; /* 楷体 */
            color: #FFD700; /* 金色文字 */
            font-size: 3.5rem; /* 字号加大 */
            font-weight: bold;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.4); /* 文字阴影增加立体感 */
            letter-spacing: 5px;
            margin: 0;
        }
        
        .site-subtitle {
            color: #ffcccc;
            margin-top: 5px;
            font-size: 0.9rem;
            letter-spacing: 2px;
        }

        /* 2. 导航栏 (紧贴 Header 下方) */
        .custom-navbar {
            background-color: #8E1616 !important;
            border-radius: 0;
            padding: 0;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        }
        
        .navbar-nav {
            width: 100%;
            display: flex;
            /*justify-content: center; /* 居中排列 */
            margin: 0;
            padding: 0;
            list-style: none;
        }
        
        .nav-item {
            flex: 1; /* 平分宽度 */
            text-align: center;
            border-right: 1px solid rgba(255,255,255,0.1);
        }

        .nav-link {
            color: white !important;
            font-size: 1.1rem;
            padding: 18px 0 !important;
            display: block;
            transition: 0.3s;
        }

        .nav-link:hover {
            background-color: #680e0e;
            color: #FFD700 !important;
        }

        /* 页脚 */
        .footer-section {
            background: #333;
            color: #ccc;
            padding: 40px 0;
            margin-top: 50px;
            text-align: center;
            border-top: 5px solid #B71C1C;
        }
    </style>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

    <div class="site-header position-relative"> <div style="
            position: absolute;
            left: 30px;        /* 【关键】距离屏幕左边缘 30px */
            top: 50%;          /* 垂直居中 */
            transform: translateY(-50%);
            z-index: 20;       /* 层级最高，防止被挡住 */
            
            background: #fff; 
            width: 120px;      
            height: 120px;
            border-radius: 50%; 
            overflow: hidden;
            
            display: flex; 
            align-items: center; 
            justify-content: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.4);
            border: 3px solid #FFD700;
        ">
            <img src="<?= Url::to('@web/image/index-images/Great_Wall.png') ?>" 
                 alt="Logo" 
                 style="width: 75%; height: auto; object-fit: contain;"> 
        </div>

        <div class="container">
            <div class="text-center">
                <h1 class="site-title-text" style="line-height: 1; margin-bottom: 10px;">中国抗战胜利80周年纪念网</h1>
                <p class="site-subtitle" style="margin-bottom: 0; font-size: 1rem; opacity: 0.9;">铭记历史 · 缅怀先烈 · 珍爱和平 · 开创未来</p>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar sticky-top">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="<?= Url::to(['/site/index']) ?>">首页</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= Url::to(['/event/index']) ?>">抗战时间轴</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= Url::to(['/character/index']) ?>">英雄与部队</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= Url::to(['/mem/index']) ?>">网上纪念馆</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= Url::to(['/interactive/index']) ?>">互动中心</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <?= $content ?>

    <footer class="footer-section">
        <div class="container">
            <p style="margin-bottom: 5px; font-weight: bold; font-size: 1.1rem;">
                &copy; 2025 抗战80周年纪念项目组 | 铭记历史 吾辈自强
            </p>
            <p style="font-size: 0.8rem; color: #888; margin-bottom: 15px;">
                基于 Yii2 框架开发
            </p>

            <hr style="border-top: 1px solid #555; width: 60%; margin: 10px auto;">

            <p style="font-size: 0.9rem; line-height: 1.8; color: #ccc;">
                主办单位：计算机学院 2023级 Group 方圆双睿 <br>
                <span style="margin: 0 10px;">团队成员：吉圆伟，刘成蕊，丛方昊，滕一睿</span> 
            </p>
            
            <p style="font-size: 0.8rem; color: #666; margin-top: 10px;">
                联系邮箱：2311786@mail.nankai.edu.cn | 地址：南开大学津南校区
            </p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>