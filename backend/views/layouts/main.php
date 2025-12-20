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
                <?php $c = Yii::$app->controller->id; ?>
                <li class="sidebar-header">Main</li>
                <li class="sidebar-item <?= $c === 'site' && Yii::$app->controller->action->id === 'index' ? 'active' : '' ?>">
                    <a class="sidebar-link" href="<?= \yii\helpers\Url::to(['/site/index']) ?>">
                        <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-header">Data Management</li>
                <li class="sidebar-item <?= $c === 'characters' ? 'active' : '' ?>">
                    <a class="sidebar-link" href="<?= \yii\helpers\Url::to(['/characters/index']) ?>">
                        <i class="align-middle" data-feather="users"></i> <span class="align-middle">人物管理</span>
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