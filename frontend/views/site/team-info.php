<?php
/**
 * frontend/views/site/team-info.php
 * 团队介绍视图文件
 * 包含：数字化抗战档案管理小组 / 开发者团队介绍
 * @author 2311786 吉圆伟
 * @date 2025-12-21
 */
use yii\helpers\Html;
use yii\helpers\Url;

$info = $data['team_info'];
$members = $data['members'];
$this->title = '团队介绍 - ' . $info['team_name'];
?>

<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold"><?= Html::encode($info['team_name']) ?></h1>
        <p class="text-muted">数字化抗战档案管理小组 / 开发者团队</p>
        <div class="mx-auto" style="width: 60px; height: 4px; background: #891e18;"></div>
    </div>

    <div class="row mb-5">
        <?php foreach ($members as $member): ?>
            <div class="col-12 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm team-card">
                    <div class="card-body p-4">
                        <div class="row align-items-center mb-4">
                            <div class="col-auto">
                                <img src="<?= Url::to('@web/image/our-img/' . ($member['img'] ?? 'default-avatar.png')) ?>" 
                                     class="rounded-circle border border-3 border-danger p-1" 
                                     style="width: 85px; height: 85px; object-fit: cover;">
                            </div>
                            <div class="col">
                                <h4 class="fw-bold mb-1 text-dark"><?= Html::encode($member['name']) ?></h4>
                                <span class="badge bg-light text-danger border border-danger mb-2"><?= Html::encode($member['major']) ?></span>
                                <div class="small fw-bold text-muted text-uppercase">
                                    <i class="fa fa-tag me-1"></i><?= Html::encode($member['role']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="pt-3 border-top">
                            <p class="text-muted" style="line-height: 1.8; text-align: justify; text-indent: 2em; font-size: 0.95rem;">
                                <?= Html::encode($member['intro']) ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="row">
        <div class="col-md-7 mb-4">
            <div class="card border-0 shadow-sm h-100 p-4 text-white" style="background: linear-gradient(135deg, #891e18 0%, #b71c1c 100%);">
                <h3 class="fw-bold mb-3"><i class="fa fa-users me-2"></i>关于 <?= Html::encode($info['team_name']) ?></h3>
                <p style="opacity: 0.9; line-height: 2; text-align: justify;"><?= Html::encode($info['intro']) ?></p>
            </div>
        </div>
        <div class="col-md-5 mb-4">
            <div class="card border-0 shadow-sm h-100 p-4 border-top border-danger border-4">
                <h3 class="fw-bold mb-3 text-danger"><i class="fa fa-compass me-2"></i><?= Html::encode($info['philosophy_title']) ?></h3>
                <ul class="list-unstyled">
                    <?php foreach ($info['philosophy_items'] as $item): ?>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fa fa-check-circle text-success me-2 mt-1"></i>
                            <div>
                                <strong class="d-block text-dark"><?= Html::encode($item['title']) ?></strong>
                                <span class="text-muted small"><?= Html::encode($item['desc']) ?></span>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
.team-card { transition: all 0.3s ease; }
.team-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
</style>