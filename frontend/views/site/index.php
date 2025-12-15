<?php
use yii\helpers\Html;
use yii\helpers\Url;

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
                <img src="<?= Url::to('@web/image/index-images/banner1.png') ?>" class="index-banner-img">
                <div class="carousel-caption d-none d-md-block"><h3>铭记历史 · 珍爱和平</h3></div>
            </div>
            <div class="carousel-item">
                <img src="<?= Url::to('@web/image/index-images/banner2.png') ?>" class="index-banner-img">
                <div class="carousel-caption d-none d-md-block"><h3>一寸山河一寸血</h3></div>
            </div>
            <div class="carousel-item">
                <img src="<?= Url::to('@web/image/index-images/banner3.png') ?>" class="index-banner-img">
                <div class="carousel-caption d-none d-md-block"><h3>勿忘国耻 吾辈自强</h3></div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#indexCarousel" role="button" data-slide="prev"><span class="carousel-control-prev-icon"></span></a>
        <a class="carousel-control-next" href="#indexCarousel" role="button" data-slide="next"><span class="carousel-control-next-icon"></span></a>
    </div>
</div>

<div class="nav_gg">
    <div class="gg-left"><span class="gg-title">最新公告</span></div>
    <div class="gg-content">
        <marquee onmouseover="this.stop()" onmouseout="this.start()">
            <a href="#" style="margin-right: 50px; color:#333;">【通知】纪念馆将于9月18日免费开放</a>
            <a href="#" style="margin-right: 50px; color:#333;">【活动】抗战老兵口述历史征集活动启动</a>
        </marquee>
    </div>
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="news-box" style="max-width: 1600px; margin: 20px auto 40px; padding: 0 20px;">
    <div class="top-news" style="
        display: flex; 
        align-items: center; 
        padding: 30px 50px; 
        border: 2px solid #ef8b1f; /* 金色边框 */
        background-color: #891e18; /* 深红背景 */
        color: #fff;
        border-radius: 5px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    ">
        <div class="title" style="
            flex-shrink: 0;
            width: 120px;
            height: 80px;
            margin-right: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-left: 3px solid #ef8b1f;  /* 左装饰线 */
            border-right: 3px solid #ef8b1f; /* 右装饰线 */
            font-size: 28px;
            font-weight: bold;
            color: #ffffc7; /* 浅金色文字 */
            line-height: 1.2;
            text-align: center;
        ">
            特别<br>关注
        </div>

        <div class="centent" style="flex: 1;">
            <a href="#" style="
                font-size: 26px; 
                font-weight: bold; 
                line-height: 1.5; 
                color: #f1e5c5; 
                text-decoration: none; 
                display: block;
                margin-bottom: 10px;
            ">
                习近平：铭记历史 缅怀先烈 珍爱和平 开创未来
            </a>
            <div style="font-size: 16px; color: #ffcccc; opacity: 0.8;">
                —— 在纪念中国人民抗日战争暨世界反法西斯战争胜利80周年座谈会上的讲话
            </div>
        </div>
        
        <div style="margin-left: 20px;">
            <a href="#" class="btn btn-outline-warning btn-sm" style="border-radius: 20px;">阅读全文 &raquo;</a>
        </div>
    </div>
</div>
            <div class="section-box mb-5">
                <h3 class="section-title"><span>重大战役</span> <small>MAJOR BATTLES</small></h3>
                <div class="row">
                    <?php foreach ($battles as $battle): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 border-0 shadow-sm hover-card">
                                <div class="img-wrapper" style="height:150px; overflow:hidden;">
                                    <img src="<?= Url::to('@web/image/index-images/battle.jpg') ?>" style="width:100%; height:100%; object-fit:cover;">
                                </div>
                                <div class="card-body p-3">
                                    <h6 class="font-weight-bold text-danger"><?= Html::encode($battle->name) ?></h6>
                                    <p class="small text-muted mb-2"><?= $battle->start_date ?></p>
                                    <a href="<?= Url::to(['event/view', 'id' => $battle->id]) ?>" class="btn btn-outline-danger btn-sm btn-block">查看详情</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="section-box mb-5">
                <h3 class="section-title"><span>抗战雄师</span> <small>HEROIC TROOPS</small></h3>
                <div class="list-group">
                    <?php foreach ($teams as $team): ?>
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start border-left-0 border-right-0">
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
                                <?php 
                                    $imgUrl = Url::to('@web' . $work->url); 
                                    //以此防止数据库路径写错导致裂图，加个默认图逻辑(可选)
                                    // if(empty($work->url)) $imgUrl = Url::to('@web/image/index-images/banner1.png');
                                ?>
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
                <div class="card border-danger mb-3">
                    <div class="card-header bg-danger text-white font-weight-bold">
                        <i class="fa fa-star"></i> 每日英烈
                    </div>
                    <?php if ($hero): ?>
                        <div style="width: 100%; height: 350px; background: #f8f9fa; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                            <img src="<?= Url::to('@web' . $hero->url) ?>" 
                                 alt="<?= $hero->name ?>" 
                                 style="
                                    max-width: 100%; 
                                    max-height: 100%; 
                                    width: auto; 
                                    height: auto; 
                                    object-fit: contain; /* 【关键】保证图片完整显示，不裁切 */
                                 ">
                        </div>
                        
                        <div class="card-body">
                            <h5 class="card-title text-center font-weight-bold"><?= Html::encode($hero->name) ?></h5>
                            <p class="card-text text-muted small"><?= mb_substr($hero->biography, 0, 60) ?>...</p>
                            <a href="<?= Url::to(['character/view', 'id' => $hero->id]) ?>" class="btn btn-danger btn-sm btn-block">瞻仰生平</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="list-group mb-4 shadow-sm">
                <a href="<?= Url::to(['interactive/quiz']) ?>" class="list-group-item list-group-item-action active bg-danger border-danger">
                    <i class="fa fa-trophy"></i> 知识竞答挑战
                </a>
                <a href="<?= Url::to(['interactive/message']) ?>" class="list-group-item list-group-item-action">
                    <i class="fa fa-pencil"></i> 我要留言寄语
                </a>
                <a href="<?= Url::to(['mem/index']) ?>" class="list-group-item list-group-item-action">
                    <i class="fa fa-university"></i> VR 网上展馆
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

        </div>
    </div>
</div>

<style>
/* 局部小样式补充 */
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
</style>