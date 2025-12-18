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
                <img src="https://www.yiiframework.com/image/design/logo/yii3_sign_blue.svg" alt="Yii Logo" style="height: 24px; margin-right: 8px;">
                <span class="align-middle">Admin System</span>
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
                        <i class="align-middle" data-feather="users"></i> <span class="align-middle">人物管理 (Characters)</span>
                    </a>
                </li>
                 <li class="sidebar-item <?= $c === 'forces' ? 'active' : '' ?>">
                    <a class="sidebar-link" href="#">
                        <i class="align-middle" data-feather="shield"></i> <span class="align-middle">势力分布</span>
                    </a>
                </li>

                <li class="sidebar-header">Analysis</li>
                <li class="sidebar-item">
                     <a class="sidebar-link" href="<?= \yii\helpers\Url::to(['/site/charts']) ?>">
                        <i class="align-middle" data-feather="pie-chart"></i> <span class="align-middle">数据可视化</span>
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

            <form class="d-none d-sm-inline-block shadow-none ms-3">
                <div class="input-group">
                    <span class="input-group-text border-0 bg-transparent text-muted"><i data-feather="search"></i></span>
                    <input type="text" class="form-control border-0 bg-transparent" placeholder="Search..." aria-label="Search">
                </div>
            </form>

            <div class="navbar-collapse collapse">
                <ul class="navbar-nav navbar-align align-items-center">
                    
                    <li class="nav-item">
                        <a class="nav-icon" href="#">
                            <i class="align-middle" data-feather="bell"></i>
                            <span class="indicator">4</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-icon" href="#">
                            <i class="align-middle" data-feather="settings"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-icon" href="#" id="mode-toggle" title="切换模式">
                            <i class="align-middle" id="theme-icon" data-feather="moon"></i>
                        </a>
                    </li>

                    <li class="nav-item px-2 d-none d-sm-block">|</li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                            <div class="nav-user-info d-none d-md-block me-2">
                                <span class="nav-user-name">
                                    <?= !Yii::$app->user->isGuest ? Yii::$app->user->identity->username : 'Admin User' ?>
                                </span>
                                <span class="nav-user-role">超级管理员</span>
                            </div>
                            <img src="/adminkit/img/avatars/avatar.jpg" class="admin-avatar-nav" alt="User" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="user"></i> 个人中心</a>
                            <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="settings"></i> 账户设置</a>
                            <div class="dropdown-divider"></div>
                            <?= Html::a('<i class="align-middle me-1" data-feather="log-out"></i> 退出登录', 
                                ['/site/logout'], 
                                ['class' => 'dropdown-item', 'data-method' => 'post']
                            ) ?>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="content">
            <div class="container-fluid p-0">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </main>

        <footer class="footer">
            <div class="container-fluid">
                <div class="row text-muted">
                    <div class="col-6 text-start">
                        <p class="mb-0"><strong>Admin System</strong> &copy; <?= date('Y') ?></p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<?php $this->endBody() ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const toggle = document.getElementById('mode-toggle');
    const body = document.body;
    const themeIcon = document.getElementById('theme-icon');

    // 辅助函数：更新图标
    function updateIcon(isDark) {
        // 由于 feather icons 渲染后会把 <i> 变成 <svg>，我们需要重新设置 data-feather 并调用 replace
        if (isDark) {
            themeIcon.setAttribute('data-feather', 'sun'); // 深色模式下显示太阳
        } else {
            themeIcon.setAttribute('data-feather', 'moon'); // 浅色模式下显示月亮
        }
        if (window.feather) {
            window.feather.replace(); 
        }
    }

    // 1. 初始化
    if (localStorage.getItem('theme') === 'dark') {
        body.setAttribute('data-theme', 'dark');
        updateIcon(true);
    } else {
        updateIcon(false);
    }

    // 2. 点击切换
    toggle.addEventListener('click', function(e) {
        e.preventDefault();
        
        if (body.getAttribute('data-theme') === 'dark') {
            // 切换到浅色
            body.removeAttribute('data-theme');
            localStorage.setItem('theme', 'light');
            updateIcon(false); // 变回月亮
        } else {
            // 切换到深色
            body.setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark');
            updateIcon(true); // 变成太阳
        }
    });
});
</script>

</body>
</html>
<?php $this->endPage() ?>