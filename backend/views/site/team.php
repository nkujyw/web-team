<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '团队成员';
?>

<div class="container-fluid p-0">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-2 fw-bold">开发团队介绍</h1>
        </div>
    </div>

    <div class="row">
        <?php foreach ($team as $member): ?>
            <div class="col-12 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm team-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4">
                            <div class="avatar-container me-3">
                                <img src="<?= Url::to('@web/img/team/' . $member['img']) ?>" 
                                     alt="<?= Html::encode($member['name']) ?>" 
                                     class="img-fluid rounded-circle border border-2 border-primary shadow-sm"
                                     style="width: 80px; height: 80px; object-fit: cover;">
                            </div>
                            <div>
                                <h4 class="mb-1 fw-bold"><?= Html::encode($member['name']) ?></h4>
                                <div class="d-flex flex-column">
                                    <span class="badge bg-primary-light text-primary align-self-start mb-1" style="font-size: 0.75rem;">
                                        <?= Html::encode($member['major']) ?>
                                    </span>
                                    <span class="small fw-bold text-muted text-uppercase">
                                        <?= Html::encode($member['role']) ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="intro-box p-3 rounded" style="background: rgba(0,0,0,0.02);">
                            <p class="card-text mb-0" style="line-height: 1.7; text-align: justify; text-indent: 2em;">
                                <?= Html::encode($member['intro']) ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
/* 悬停浮起动画 */
.team-card {
    transition: all 0.3s ease;
}
.team-card:hover {
    transform: translateY(-5px);
}

/* 浅色模式下的浅蓝色背景标签 */
.bg-primary-light {
    background-color: rgba(59, 93, 231, 0.1);
}

/* 暗黑模式适配补丁 */
body[data-theme="dark"] .team-card {
    background-color: #222736 !important;
}
body[data-theme="dark"] .intro-box {
    background: rgba(255, 255, 255, 0.03) !important;
}
body[data-theme="dark"] .intro-box p {
    color: #adb5bd !important;
}
body[data-theme="dark"] .bg-primary-light {
    background-color: rgba(91, 183, 255, 0.2);
    color: #5bb7ff !important;
}
</style>