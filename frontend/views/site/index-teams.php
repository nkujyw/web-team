<?php
/**
 * index-teams.php
 * 抗战雄师详情聚合页视图文件
 * 显示多个抗战雄师的详细信息。
 * @author 吉圆伟
 * @date 2025-12-15
 */
use yii\helpers\Html;
use yii\helpers\Url;


$this->title = '抗战雄师';
?>

<div class="team-index" style="background-color: #f4f6f9; min-height: 100vh; padding: 50px 0;">
    <div class="container">
        
        <div class="text-center mb-5">
            <h2 class="font-weight-bold display-4" style="color: #B71C1C; font-family: 'SimHei';">抗战雄师</h2>
            <p class="lead text-muted">中华民族的钢铁脊梁</p>
            <div style="width: 80px; height: 4px; background: #B71C1C; margin: 20px auto; border-radius: 2px;"></div>
        </div>

        <div class="row">
            <?php foreach ($teams as $team): ?>
                
                <?php 

                    $isRed = ($team->force_id == 6);
                    $themeColor = $isRed ? '#d9534f' : '#337ab7'; // Bootstrap Danger红 vs Primary蓝
                    $badgeClass = $isRed ? 'badge-danger' : 'badge-primary';
                ?>

                <div class="col-lg-6 col-md-12 mb-4">
                    
                    <div class="card shadow-sm h-100 border-0 team-card" id="team-<?= $team->id ?>" 
                         style="border-top: 5px solid <?= $themeColor ?> !important; border-radius: 10px;">
                        
                        <div class="card-body p-4 d-flex flex-column">
                            
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h3 class="font-weight-bold mb-2" style="color: #333; font-size: 24px;">
                                        <?= Html::encode($team->name) ?>
                                    </h3>
                                    <span class="badge <?= $badgeClass ?> px-2 py-1">
                                        <?= $team->force ? Html::encode($team->force->name) : '抗日武装' ?>
                                    </span>
                                </div>
                                <div class="text-right text-muted small">
                                    <div class="mb-1"><i class="fa fa-calendar-check-o"></i> 成立时间</div>
                                    <div class="font-weight-bold"><?= $team->founded_date ?></div>
                                </div>
                            </div>

                            <hr style="border-top: 1px dashed #eee; width: 100%;">

                            <div class="team-desc mb-4" style="color: #666; text-indent: 2em; line-height: 1.8; text-align: justify;">
                                <?= Html::encode($team->description) ?>
                            </div>

                            <?php if ($team->leader): ?>
                                <div class="mt-3 text-right text-muted small border-top pt-2">
                                    <i class="fa fa-user"></i> 指挥官：<?= Html::encode($team->leader->name) ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>

        <div class="text-center mt-5">
            <a href="<?= Url::to(['site/index']) ?>" class="btn btn-outline-secondary btn-lg px-5 rounded-pill shadow-sm">
                <i class="fa fa-reply"></i> 返回首页
            </a>
        </div>

    </div>
</div>

<style>
.team-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.team-card:hover {
    transform: translateY(-8px); /* 上浮效果 */
    box-shadow: 0 1rem 3rem rgba(0,0,0,.15)!important; /* 阴影加深 */
}
</style>