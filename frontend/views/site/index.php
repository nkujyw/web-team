<?php
/**
 * site/index.php
 * 首页视图文件
 * 包含：首页轮播图、最新公告、特别关注、重大战役、抗战雄师、抗战文艺、每日英雄等模块
 * @author 2311786 吉圆伟
 * @date 2025-12-16
 */
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $battles common\models\Events[] */
/* @var $hero common\models\Characters */
/* @var $carouselWorks common\models\MemWorks[] */
/* @var $artWorks common\models\MemWorks[] */
/* @var $teams common\models\Teams[] */
/* @var $recentMessages common\models\Messages[] */

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
    
    <div class="gg-content" style="overflow: hidden; position: relative;">
        <div class="seamless-scroll-box">
            
            <a href="<?= Url::to(['site/announcement', 'id' => 1]) ?>">【通知】纪念馆将于9月18日免费开放</a>
            <a href="<?= Url::to(['site/announcement', 'id' => 2]) ?>">【活动】“寻找抗战记忆”老兵口述历史征集活动启动</a>
            <a href="<?= Url::to(['site/announcement', 'id' => 3]) ?>">【新闻】我馆举办抗战文物巡回展</a>
            <a href="<?= Url::to(['site/announcement', 'id' => 4]) ?>">【活动】“红色家书”诵读活动报名开始</a>
            <a href="<?= Url::to(['site/announcement', 'id' => 5]) ?>">【招募】2025暑期大学生志愿讲解员招募</a>
            <a href="<?= Url::to(['site/announcement', 'id' => 6]) ?>">【征集】面向社会征集抗战文物的公告</a>

            <a href="<?= Url::to(['site/announcement', 'id' => 1]) ?>">【通知】纪念馆将于9月18日免费开放</a>
            <a href="<?= Url::to(['site/announcement', 'id' => 2]) ?>">【活动】“寻找抗战记忆”老兵口述历史征集活动启动</a>
            <a href="<?= Url::to(['site/announcement', 'id' => 3]) ?>">【新闻】我馆举办抗战文物巡回展</a>
            <a href="<?= Url::to(['site/announcement', 'id' => 4]) ?>">【活动】“红色家书”诵读活动报名开始</a>
            <a href="<?= Url::to(['site/announcement', 'id' => 5]) ?>">【招募】2025暑期大学生志愿讲解员招募</a>
            <a href="<?= Url::to(['site/announcement', 'id' => 6]) ?>">【征集】面向社会征集抗战文物的公告</a>

        </div>
    </div>
</div>
<div style="width: 100%; background-color: #891e18; border-top: 2px solid #ef8b1f; border-bottom: 2px solid #ef8b1f; margin-bottom: 40px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
    <div class="container">
        <div class="top-news" style="display: flex; align-items: center; padding: 30px 0; color: #fff;">
            
            <div class="title" style="
                flex-shrink: 0;
                width: 140px;
                margin-right: 40px;
                display: flex;
                justify-content: center;
                align-items: center;
                border-left: 3px solid #ef8b1f;
                border-right: 3px solid #ef8b1f;
                font-size: 30px;
                font-weight: bold;
                color: #ffffc7;
                line-height: 1.2;
                text-align: center;
                padding: 10px 0;
            ">
                特别<br>关注
            </div>

            <div class="centent" style="flex: 1;">
                <a href="<?= Url::to(['site/speech']) ?>"style="
                    font-size: 28px; 
                    font-weight: bold; 
                    line-height: 1.5; 
                    color: #f1e5c5; 
                    text-decoration: none; 
                    display: block;
                    margin-bottom: 8px;
                    text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
                ">
                    习近平：铭记历史 缅怀先烈 珍爱和平 开创未来
                </a>
                <div style="font-size: 16px; color: #ffcccc; opacity: 0.9;">
                    —— 在纪念中国人民抗日战争暨世界反法西斯战争胜利80周年座谈会上的讲话
                </div>
            </div>
            
            <div style="margin-left: 30px;">
                <a href="<?= Url::to(['site/speech']) ?>" class="btn btn-outline-warning" style="border-radius: 50px; padding: 8px 25px; border-width: 2px;">阅读全文 &raquo;</a>
            </div>
            
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col-lg-8">
            
            <div class="section-box mb-5">
                <h3 class="section-title"><span>重大战役</span> <small>MAJOR BATTLES</small></h3>
                <div class="row">
                    <?php foreach ($battles as $battle): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 border-0 shadow-sm hover-card">
                                <div class="img-wrapper" style="height:150px; overflow:hidden;">
                                    <?php
                                        $imgName = 'battle.jpg'; 

                                        switch ($battle->id) {
                                            case 1: 
                                                $imgName = 'luGouQiao.png'; // 对应卢沟桥事变
                                                break;
                                            case 2: 
                                                $imgName = 'songHu.png';    // 对应淞沪会战
                                                break;
                                            case 7: 
                                                $imgName = 'taiYuan.png';   // 对应太原会战 
                                                break;
                                        }

                                        // 拼接完整路径
                                        $finalUrl = Url::to('@web/image/index-images/' . $imgName);
                                    ?>
                                    <img src="<?= $finalUrl ?>" style="width:100%; height:100%; object-fit:cover;">
                                </div>
                                
                                <div class="card-body p-3">
                                    <h6 class="font-weight-bold text-danger"><?= Html::encode($battle->name) ?></h6>
                                    <p class="small text-muted mb-2"><i class="fa fa-calendar"></i> <?= $battle->start_date ?></p>
                                    <p class="card-text text-secondary small" style="height: 40px; overflow: hidden;">
                                        <?= mb_substr(strip_tags($battle->description), 0, 35) ?>...
                                    </p>
                                    <a href="<?= Url::to(['event/important-battle', 'id' => $battle->id]) ?>" class="btn btn-outline-danger btn-sm btn-block">查看战况</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="section-box mb-5">
                <h3 class="section-title"><span>抗战雄师</span> <small>HEROIC TROOPS</small></h3>
                
                <?php 
                    // 1. 先把这 4 个随机队伍的 ID 提取出来
                    $teamIds = [];
                    foreach ($teams as $t) {
                        $teamIds[] = $t->id;
                    }
                    // 2. 拼成字符串
                    $idsString = implode(',', $teamIds); 
                ?>

                <div class="list-group">
                    <?php foreach ($teams as $team): ?>
                        
                        <a href="<?= Url::to(['site/index-teams', 'ids' => $idsString, '#' => 'team-' . $team->id]) ?>" class="list-group-item list-group-item-action flex-column align-items-start border-left-0 border-right-0">
                            
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1 text-dark"><i class="fa fa-flag text-danger"></i> <?= Html::encode($team->name) ?></h5>
                                <small class="text-muted">成立时间：<?= $team->founded_date ?></small>
                            </div>
                            <p class="mb-1 text-secondary small"><?= mb_substr($team->description, 0, 80) ?>...</p>
                        
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="section-box mb-5">
                <h3 class="section-title"><span>抗战文艺</span> <small>CULTURAL WORKS</small></h3>
                <div class="row">
                    <?php foreach ($artWorks as $work): ?>
                        <div class="col-6 mb-3">
                            <div class="position-relative text-white hover-zoom" style="height: 180px; overflow: hidden; border-radius: 5px; cursor: pointer;">
                                <?php $imgUrl = Url::to('@web' . $work->url); ?>
                                <img src="<?= $imgUrl ?>" style="width:100%; height:100%; object-fit:cover; transition: transform 0.5s;">
                                <div class="position-absolute w-100 h-100" style="top:0; left:0; background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);"></div>
                                <div class="position-absolute" style="bottom: 10px; left: 15px;">
                                    <h5 class="mb-0" style="font-size: 1rem;"><?= Html::encode($work->name) ?></h5>
                                    <small style="opacity: 0.8;"><?= $work->type ?> | <?= $work->author ?></small>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>

        <div class="col-lg-4">
            
            <div class="mb-4">
                <div class="card border-danger mb-3 shadow hero-card-hover" style="transition: all 0.3s;">
                    
                    <div class="card-header bg-danger text-white font-weight-bold d-flex justify-content-between align-items-center">
                        <span><i class="fa fa-star"></i> 每日英雄</span>
                        <span class="badge badge-light text-danger">今日缅怀</span>
                    </div>

                    <?php if ($hero): ?>
                        
                        <div class="hero-img-box bg-white text-center border-bottom" style="height: 320px; overflow: hidden; padding: 10px;">
                             <img src="<?= Url::to('@web' . $hero->url) ?>" 
                                  alt="<?= $hero->name ?>" 
                                  style="max-width: 100%; max-height: 100%; object-fit: contain;">
                        </div>

                        <div class="hero-name-bar bg-white text-center py-2" style="border-bottom: 1px solid #eee; position: relative; z-index: 2;">
                            <h4 class="text-danger font-weight-bold mb-0"><?= Html::encode($hero->name) ?></h4>
                            <small class="text-muted"><?= Html::encode($hero->rank ?? '民族英雄') ?></small>
                            <div class="text-muted small mt-1"><i class="fa fa-chevron-down transition-icon"></i></div>
                        </div>

                        <div class="hero-details bg-white border-top-0" 
                             style="
                                max-height: 0;       /* 默认关上 */
                                overflow: hidden;    /* 内容藏起来 */
                                transition: max-height 0.5s ease-in-out; /* 0.5秒平滑过渡 */
                             ">
                             
                             <div class="p-3" style="background-color: #fffbfb;">
                                <strong class="d-block text-danger border-bottom pb-2 mb-2">【生平事迹】</strong>
                                <div class="text-secondary small text-justify" style="line-height: 1.8;">
                                    <?= nl2br(Html::encode($hero->biography)) ?>
                                    
                                    <?php if (!empty($hero->achievements)): ?>
                                         <hr style="margin: 10px 0; border-top: 1px dashed #ddd;">
                                         <strong class="d-block text-danger mb-2">【主要功绩】</strong>
                                         <?= nl2br(Html::encode($hero->achievements)) ?>
                                    <?php endif; ?>
                                </div>
                             </div>

                        </div>

                    <?php endif; ?>
                </div>
            </div>

            <div class="list-group mb-4 shadow-sm">
                <a href="<?= Url::to(['interactive/index']) ?>" class="list-group-item list-group-item-action active bg-danger border-danger">
                    <i class="fa fa-trophy"></i> 知识竞答挑战
                </a>
                <a href="<?= Url::to(['interactive/index', 'tab' => 'message']) ?>" class="list-group-item list-group-item-action">
                    <i class="fa fa-pencil"></i> 我要留言寄语
                </a>
                <a href="<?= Url::to(['mem/index']) ?>" class="list-group-item list-group-item-action">
                    <i class="fa fa-university"></i> 网上展馆
                </a>
            </div>

            <div class="card">
                <div class="card-header bg-light font-weight-bold">
                    <i class="fa fa-commenting-o"></i> 最新寄语
                </div>
                <ul class="list-group list-group-flush">
                    <?php foreach ($recentMessages as $msg): ?>
                        <li class="list-group-item small text-muted" style="background: #fdfdfd;">
                            <i class="fa fa-quote-left text-danger"></i> 
                            <?= mb_substr(Html::encode($msg->message), 0, 20) ?>...
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="card mt-4 shadow-sm border-0">
                <div class="card-header bg-dark text-white font-weight-bold">
                    <i class="fa fa-info-circle"></i> 关于我们
                </div>
            <div class="card-body text-center p-4">
                <div class="mb-3">
                    <i class="fa fa-users fa-3x text-danger"></i>
                </div>
                    <h5 class="card-title">开发小组</h5>
                    <p class="card-text small text-muted">铭记历史，用技术传承民族精神。</p>
                    <a href="<?= Url::to(['site/team-info']) ?>" class="btn btn-danger btn-block">查看团队介绍</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* 局部样式补充 */
.section-title {
    border-left: 5px solid #B71C1C;
    padding-left: 15px;
    margin-bottom: 25px;
    font-weight: bold;
}
.section-title small {
    color: #999;
    font-size: 14px;
    margin-left: 10px;
    font-weight: normal;
}
.hover-card:hover {
    transform: translateY(-5px);
    transition: all 0.3s;
    box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
}


/* 滚动容器：让链接横向排列，不换行 */
.seamless-scroll-box {
    display: flex;
    align-items: center;
    white-space: nowrap; /* 强制不换行 */
    animation: scroll-left 40s linear infinite;
}

/* 鼠标放上去时暂停，方便用户点击 */
.seamless-scroll-box:hover {
    animation-play-state: paused;
}

/* 链接样式微调 */
.seamless-scroll-box a {
    color: #333;
    text-decoration: none;
    margin-right: 50px; /* 每条公告之间的间距 */
    font-weight: 500;
}

/* 核心动画定义 */
@keyframes scroll-left {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}

/* 1. 鼠标放上去：把最大高度设大，撑开页面 */
.hero-card-hover:hover .hero-details {
 max-height: 800px !important; /* 设置一个足够大的值 */
}

/* 2. 鼠标放上去：箭头旋转 */
.hero-card-hover:hover .transition-icon {
transform: rotate(180deg);
}
.transition-icon {
    transition: transform 0.3s;
}
/* 3. 鼠标放上去：卡片阴影加深 */
.hero-card-hover:hover {
 box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}
</style>

