<?php

/**
*Team：方圆双睿
*Coding by 丛方昊 2310682
*纪念馆前端，简单介绍纪念馆，展示纪念作品与纪念活动
*使用@web/css/mem.css与@web/js/mem.js
*/

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $memWorks common\models\MemWorks[] */
/* @var $memActivities common\models\MemActivities[] */

$this->title = '网上纪念馆 - 中国抗战胜利80周年纪念网';

$this->registerCssFile('@web/css/mem.css');
$this->registerJsFile('@web/js/mem.js', ['position' => \yii\web\View::POS_END]);
?>

<div class="mem-classic-body">
    <div class="mem-classic-container">
        <div style="text-align: center; padding: 40px 0;">
            <h1 style="color: #B71C1C; font-family: 'KaiTi', serif; font-size: 2.8rem; margin: 0; text-shadow: 2px 2px 4px rgba(0,0,0,0.3); letter-spacing: 2px;">网上纪念馆</h1>
            <p style="color: #666; margin: 10px 0 0 0; font-style: italic; font-size: 1.2rem; letter-spacing: 1px;">铭记历史 · 缅怀先烈 · 珍爱和平</p>
        </div>

        <div class="intro-section">
            <h2 class="mem-classic-header">纪念馆简介</h2>
            <p style="line-height: 1.9; font-size: 1.2rem; color: #333; text-align: justify; text-indent: 2em;">
                这里是抗战胜利80周年网上纪念馆，我们通过数字化方式永久保存和展示抗战历史资料、英雄事迹和珍贵文物。
                让我们共同缅怀为民族独立和人民解放事业英勇献身的革命先烈，传承伟大的抗战精神，珍视来之不易的和平。
            </p>
        </div>

        <div class="mem-classic-section">
            <h2 class="mem-classic-header">纪念功能区</h2>
            
            <div class="mem-grid-2">
                <div class="mem-feature-card" id="worksCard">
                    <div class="mem-icon-circle">
                        <i class="fa fa-picture-o"></i>
                    </div>
                    <h3>纪念作品</h3>
                    <p>查看历史照片、艺术作品等纪念资料</p>
                    <button class="mem-btn-classic view-works-btn">进入查看</button>
                </div>

                <div class="mem-feature-card" id="eventsCard">
                    <div class="mem-icon-circle">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <h3>纪念活动</h3>
                    <p>参与线上纪念活动，表达哀思</p>
                    <button class="mem-btn-classic view-events-btn">参与活动</button>
                </div>
            </div>
        </div>

        <div class="mem-classic-section">
            <h2 class="mem-classic-header">推荐纪念内容</h2>
            
            <h3 style="color: #8E1616; margin: 20px 0 10px 0; font-size: 1.5rem; border-left: 5px solid #8E1616; padding-left: 10px;">纪念作品</h3>
            <div class="mem-content-list">
                <?php if (!empty($memWorks)): ?>
                    <?php foreach ($memWorks as $index => $work): ?>
                        <div class="mem-content-item mem-work-item" data-id="<?= $work->id ?>" data-type="work">
                            <div class="mem-number-circle"><?= $index + 1 ?></div>
                            <div>
                                <h4><?= Html::encode($work->name) ?></h4>
                                <p>
                                    <?= Html::encode($work->author) ?> · <?= Html::encode($work->type) ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="text-align: center; color: #666; padding: 30px; font-size: 1.2rem;">暂无纪念作品</p>
                <?php endif; ?>
            </div>
            
            <h3 style="color: #8E1616; margin: 40px 0 10px 0; font-size: 1.5rem; border-left: 5px solid #8E1616; padding-left: 10px;">纪念活动</h3>
            <div class="mem-content-list">
                <?php if (!empty($memActivities)): ?>
                    <?php foreach ($memActivities as $index => $activity): ?>
                        <div class="mem-content-item mem-activity-item" data-id="<?= $activity->id ?>" data-type="activity">
                            <div class="mem-number-circle"><?= $index + 1 ?></div>
                            <div>
                                <h4><?= Html::encode($activity->name) ?></h4>
                                <p>
                                    <?= Html::encode($activity->organizer) ?> · <?= Yii::$app->formatter->asDate($activity->activity_date, 'yyyy年MM月dd日') ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="text-align: center; color: #666; padding: 30px; font-size: 1.2rem;">暂无纪念活动</p>
                <?php endif; ?>
            </div>
        </div>

        <div style="text-align: center; padding: 40px 0; color: #666; border-top: 2px solid #e3bb67; margin-top: 40px;">
            <p style="margin: 0; font-size: 1.1rem;">
                &copy; 一寸山河一寸血，一抔抔热土一抔抔魂
            </p>
        </div>
    </div>
</div>

<div id="worksModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h2>纪念作品</h2>
            <button class="modal-close">&times;</button>
        </div>
        <div class="modal-body" id="worksModalBody">
        </div>
    </div>
</div>

<div id="eventsModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h2>纪念活动</h2>
            <button class="modal-close">&times;</button>
        </div>
        <div class="modal-body" id="eventsModalBody">
        </div>
    </div>
</div>

<div id="detailModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="detailTitle">详情</h2>
            <button class="modal-close">&times;</button>
        </div>
        <div class="modal-body" id="detailModalBody">
        </div>
    </div>
</div>

<script>
window.MemUrlsConfig = {
    getAllWorks: '<?= Url::to(['mem/get-all-works']) ?>',
    getAllActivities: '<?= Url::to(['mem/get-all-activities']) ?>',
    getWorkDetail: '<?= Url::to(['mem/get-work-detail']) ?>',
    getActivityDetail: '<?= Url::to(['mem/get-activity-detail']) ?>'
};
</script>