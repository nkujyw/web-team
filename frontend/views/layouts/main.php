<?php
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
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://cdn.bootcdn.net/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdn.bootcdn.net/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

  <div class="header_section padding_bottom_0">
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="logo"><a href="<?= Url::to(['site/index']) ?>"><img src="images/logo.png"></a></div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="<?= Url::to(['site/index']) ?>">首页</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= Url::to(['event/index']) ?>">抗战时间轴</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= Url::to(['character/index']) ?>">英雄与部队</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= Url::to(['memorial/index']) ?>">纪念馆</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= Url::to(['interaction/index']) ?>">互动中心</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>
  <?= $content ?>

  <div class="footer_section layout_padding">
    <div class="container">
      <div class="copyright_text">Copyright 2025 抗战80周年项目组</div>
    </div>
  </div>
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery-3.0.0.min.js"></script>
  <script src="js/plugin.js"></script>
  <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="js/custom.js"></script>
  <script src="js/owl.carousel.js"></script>
  <script src="https://cdn.bootcdn.net/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>