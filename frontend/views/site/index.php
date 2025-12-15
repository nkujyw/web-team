<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $battles common\models\Events[] */
/* @var $hero common\models\Characters */
/* @var $carouselWorks common\models\MemWorks[] */

$this->title = '首页 - 中国抗战胜利纪念网';
?>

<div class="container-fluid p-0">
    <div id="indexCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#indexCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#indexCarousel" data-slide-to="1"></li>
            <li data-target="#indexCarousel" data-slide-to="2"></li>
        </ol>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?= Url::to('@web/image/index-images/banner1.png') ?>" class="index-banner-img" alt="Banner 1">
                <div class="carousel-caption d-none d-md-block">
                    <h3>铭记历史 · 珍爱和平</h3>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?= Url::to('@web/image/index-images/banner2.png') ?>" class="index-banner-img" alt="Banner 2">
                <div class="carousel-caption d-none d-md-block">
                    <h3>一寸山河一寸血</h3>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?= Url::to('@web/image/index-images/banner3.png') ?>" class="index-banner-img" alt="Banner 3">
                <div class="carousel-caption d-none d-md-block">
                    <h3>勿忘国耻 吾辈自强</h3>
                </div>
            </div>
        </div>

        <a class="carousel-control-prev" href="#indexCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>
        <a class="carousel-control-next" href="#indexCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </a>
    </div>
</div>

<div class="nav_gg">
    <div class="gg-left">
        <span class="gg-title">最新公告</span>
    </div>
    <div class="gg-content">
        <marquee onmouseover="this.stop()" onmouseout="this.start()">
            <a href="#" style="margin-right: 50px; color:#333;">【通知】纪念馆将于9月18日免费开放</a>
            <a href="#" style="margin-right: 50px; color:#333;">【活动】抗战老兵口述历史征集活动启动</a>
        </marquee>
    </div>
</div>

<div class="news-box">
    <div class="top-news">
        <div class="title">特别<br>关注</div>
        <div class="centent">
            <a href="#">习近平出席纪念全民族抗战爆发88周年仪式并发表重要讲话</a>
            <a href="#" style="font-size: 18px; color: #ccc; margin-top: 10px;">铭记历史 缅怀先烈 珍爱和平 开创未来</a>
        </div>
    </div>
</div>

<div class="news">
    <div class="news-l">
        <div class="title">
            <a href="<?= Url::to(['event/index']) ?>">重大战役回顾</a>
        </div>
        <div class="content-list">
            <?php foreach ($battles as $battle): ?>
                <a href="<?= Url::to(['event/view', 'id' => $battle->id]) ?>">
                    <span class="time">[<?= $battle->start_date ?>]</span>
                    <?= Html::encode($battle->name) ?> - <?= mb_substr($battle->description, 0, 40) ?>...
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="news-r">
        <a href="<?= Url::to(['character/index']) ?>" class="m1">
            <span>抗战<br>英烈</span>
        </a>
        <a href="<?= Url::to(['mem/index']) ?>" class="m2">
            <span>网上<br>纪念馆</span>
        </a>
        <a href="<?= Url::to(['interactive/quiz']) ?>" class="m3">
            <span>知识<br>竞答</span>
        </a>
        <a href="<?= Url::to(['interactive/message']) ?>" class="m4">
            <span>留言<br>寄语</span>
        </a>
    </div>
</div>

<div class="container mb-5">
    <h3 style="border-left: 5px solid #B71C1C; padding-left: 15px; margin-bottom: 20px;">每日英烈</h3>
    <?php if ($hero): ?>
        <div class="media p-4 shadow-sm" style="background: #fff; border: 1px solid #eee;">
            <?php $heroImg = Url::to('@web' . $hero->url); ?>
            <img src="<?= $heroImg ?>" class="mr-4" alt="<?= $hero->name ?>" style="width: 150px; height: 200px; object-fit: cover;">
            <div class="media-body">
                <h4 class="mt-0 text-danger font-weight-bold"><?= Html::encode($hero->name) ?></h4>
                <p class="text-muted"><?= $hero->rank ?> | <?= $hero->force_id == 6 ? '八路军' : '国民革命军' ?></p>
                <p><?= mb_substr($hero->biography, 0, 200) ?>...</p>
                <a href="<?= Url::to(['character/view', 'id' => $hero->id]) ?>" class="btn btn-outline-danger btn-sm">查看生平</a>
            </div>
        </div>
    <?php endif; ?>
</div>