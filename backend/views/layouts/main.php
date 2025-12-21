<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

<div class="wrapper">
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="<?= \yii\helpers\Url::home() ?>">
                <div class="d-flex align-items-center">
                    <div class="logo-box">Yii</div>
                    <span class="align-middle ms-2">Admin System</span>
                </div>
            </a>

<ul class="sidebar-nav">
    <li class="sidebar-item active">
        <a class="sidebar-link" href="<?= \yii\helpers\Url::to(['/site/index']) ?>">
            <i class="align-middle" data-feather="sliders"></i> <span>控制台首页</span>
        </a>
    </li>

    <li class="sidebar-header">核心档案库</li>
    <li class="sidebar-item">
        <a data-bs-target="#history" data-bs-toggle="collapse" class="sidebar-link collapsed">
            <i class="align-middle" data-feather="archive"></i> <span>历史档案</span>
        </a>
        <ul id="history" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
            <li class="sidebar-item"><a class="sidebar-link" href="<?= \yii\helpers\Url::to(['/events/index']) ?>">大事件总表</a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="<?= \yii\helpers\Url::to(['/battle-events/index']) ?>">战役详情录</a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="<?= \yii\helpers\Url::to(['/diplomatic-events/index']) ?>">外交风云</a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="<?= \yii\helpers\Url::to(['/meeting-events/index']) ?>">重要会议</a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="<?= \yii\helpers\Url::to(['/locations/index']) ?>">地理坐标</a></li>
        </ul>
    </li>

    <li class="sidebar-header">人文与英雄</li>
    <li class="sidebar-item">
        <a data-bs-target="#people" data-bs-toggle="collapse" class="sidebar-link collapsed">
            <i class="align-middle" data-feather="users"></i> <span>人物与势力</span>
        </a>
        <ul id="people" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
            <li class="sidebar-item"><a class="sidebar-link" href="<?= \yii\helpers\Url::to(['/characters/index']) ?>">英雄人物谱</a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="<?= \yii\helpers\Url::to(['/teams/index']) ?>">参战部队</a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="<?= \yii\helpers\Url::to(['/forces/index']) ?>">阵营分类</a></li>
        </ul>
    </li>

    <li class="sidebar-header">文化纪念</li>
    <li class="sidebar-item">
        <a data-bs-target="#culture" data-bs-toggle="collapse" class="sidebar-link collapsed">
            <i class="align-middle" data-feather="heart"></i> <span>纪念展示</span>
        </a>
        <ul id="culture" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
            <li class="sidebar-item"><a class="sidebar-link" href="<?= \yii\helpers\Url::to(['/mem-works/index']) ?>">纪念作品</a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="<?= \yii\helpers\Url::to(['/mem-activities/index']) ?>">线下活动</a></li>
        </ul>
    </li>

    <li class="sidebar-header">系统与交互</li>
    <li class="sidebar-item">
        <a class="sidebar-link" href="<?= \yii\helpers\Url::to(['/question/index']) ?>">
            <i class="align-middle" data-feather="help-circle"></i> <span>知识问答库</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link" href="<?= \yii\helpers\Url::to(['/messages/index']) ?>">
            <i class="align-middle" data-feather="message-circle"></i> <span>留言审核</span>
        </a>
    </li>

    <li class="sidebar-header">作业交付</li>
    <li class="sidebar-item">
        <a data-bs-target="#homework" data-bs-toggle="collapse" class="sidebar-link collapsed">
            <i class="align-middle" data-feather="download-cloud"></i> <span>作业下载</span>
        </a>
        <ul id="homework" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
        <li class="sidebar-item">
            <a class="sidebar-link" href="<?= \yii\helpers\Url::to(['/site/team-homework']) ?>">团队作业</a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="<?= \yii\helpers\Url::to(['/site/personal-homework']) ?>">个人作业</a>
        </li>
    </ul>
    </li>

    <li class="sidebar-item">
        <a class="sidebar-link" href="<?= \yii\helpers\Url::to(['/site/team']) ?>">
            <i class="align-middle" data-feather="smile"></i> <span>团队介绍</span>
        </a>
    </li>
</ul>
        </div>
    </nav>

    <div class="main">
        <nav class="navbar navbar-expand navbar-light navbar-bg">
            <a class="sidebar-toggle js-sidebar-toggle">
                <i class="hamburger align-self-center"></i>
            </a>

            <div class="navbar-collapse collapse">
                <ul class="navbar-nav navbar-align align-items-center">
                    <li class="nav-item">
                        <a class="nav-icon" href="#">
                            <i class="align-middle" data-feather="bell"></i>
                            <span class="indicator">4</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-icon" href="#" id="mode-toggle">
                            <i class="align-middle" id="theme-icon" data-feather="moon"></i>
                        </a>
                    </li>

                    <li class="nav-item px-2 d-none d-sm-block">|</li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                            <div class="nav-user-info d-none d-md-block me-2 text-end">
                                <span class="nav-user-name">admin</span>
                                <span class="nav-user-role">超级管理员</span>
                            </div>
                            <div class="avatar-initial-wrapper">
                                <div class="avatar-initial">A</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <?= Html::a('<i class="align-middle me-1" data-feather="log-out"></i> 退出登录', 
                                ['/site/logout'], ['class' => 'dropdown-item', 'data-method' => 'post']) ?>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="content">
            <div class="container-fluid p-0">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </main>
    </div>
</div>

<?php $this->endBody() ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const toggle = document.getElementById('mode-toggle');
    const body = document.body;
    const themeIcon = document.getElementById('theme-icon');

    function updateIcon(isDark) {
        themeIcon.setAttribute('data-feather', isDark ? 'sun' : 'moon');
        if (window.feather) window.feather.replace();
    }

    if (localStorage.getItem('theme') === 'dark') {
        body.setAttribute('data-theme', 'dark');
        updateIcon(true);
    }

    toggle.addEventListener('click', function(e) {
        e.preventDefault();
        const isDark = body.getAttribute('data-theme') === 'dark';
        if (isDark) {
            body.removeAttribute('data-theme');
            localStorage.setItem('theme', 'light');
            updateIcon(false);
        } else {
            body.setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark');
            updateIcon(true);
        }
    });
});
</script>
</body>
</html>
<?php $this->endPage() ?>