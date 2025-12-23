<?php
/**
 * 团队介绍页面
 * 展示团队成员及其职责分工
 * 提供管理模式以编辑团队信息
 * @author: 2311786 吉圆伟
 * @date: 2025-12-21
 * 参考自 site/index.php 的页面结构和样式
 */
use yii\helpers\Html;
use yii\helpers\Url;

// 使用动态数据
$info = $data['team_info'];
$members = $data['members'];
$this->title = '团队介绍 - ' . $info['team_name'];
?>

<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold mb-0"><?= Html::encode($info['team_name']) ?></h1>
            <p class="text-muted small">抗日战争胜利 80 周年项目组 | 数字化管理小组</p>
        </div>
        <button class="btn btn-sm btn-primary shadow-sm" onclick="toggleEdit()">
            <i class="align-middle" data-feather="settings"></i> 管理模式
        </button>
    </div>

    <div id="edit-form" style="display: none;" class="mb-5 animate__animated animate__fadeIn">
        <?= Html::beginForm(['site/team'], 'post') ?>
            <div class="card shadow-sm border-primary mb-4">
                <div class="card-header bg-primary text-white fw-bold">1. 团队全局信息与理念修改</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="small fw-bold">队名</label>
                            <input type="text" name="TeamInfo[team_name]" class="form-control" value="<?= Html::encode($info['team_name']) ?>">
                        </div>
                        <div class="col-md-8 mb-3">
                            <label class="small fw-bold">团队总体介绍</label>
                            <textarea name="TeamInfo[intro]" class="form-control" rows="2"><?= Html::encode($info['intro']) ?></textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small fw-bold">理念板块标题</label>
                            <input type="text" name="TeamInfo[philosophy_title]" class="form-control" value="<?= Html::encode($info['philosophy_title']) ?>">
                        </div>
                        <div class="col-12 mt-2">
                            <label class="small fw-bold text-primary mb-2">理念条目修改</label>
                            <div class="row">
                                <?php foreach ($info['philosophy_items'] as $i => $item): ?>
                                    <div class="col-md-4 mb-2">
                                        <div class="p-2 border rounded bg-light">
                                            <input type="text" name="Philosophy[<?= $i ?>][title]" class="form-control form-control-sm mb-1" value="<?= Html::encode($item['title']) ?>" placeholder="理念标题">
                                            <input type="text" name="Philosophy[<?= $i ?>][desc]" class="form-control form-control-sm" value="<?= Html::encode($item['desc']) ?>" placeholder="理念描述">
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php foreach ($members as $index => $member): ?>
                    <div class="col-md-6 mb-3">
                        <div class="card p-3 border shadow-none">
                            <h6 class="fw-bold mb-3 text-info">成员：<?= Html::encode($member['name']) ?></h6>
                            <div class="row g-2">
                                <div class="col-6">
                                    <label class="small">姓名</label>
                                    <input type="text" name="Members[<?= $index ?>][name]" class="form-control form-control-sm" value="<?= Html::encode($member['name']) ?>">
                                </div>
                                <div class="col-6">
                                    <label class="small">专业</label>
                                    <input type="text" name="Members[<?= $index ?>][major]" class="form-control form-control-sm" value="<?= Html::encode($member['major']) ?>">
                                </div>
                                <div class="col-12">
                                    <label class="small">模块职责</label>
                                    <input type="text" name="Members[<?= $index ?>][role]" class="form-control form-control-sm" value="<?= Html::encode($member['role']) ?>">
                                </div>
                                <div class="col-12">
                                    <label class="small">个人详细介绍</label>
                                    <textarea name="Members[<?= $index ?>][intro]" class="form-control form-control-sm" rows="3"><?= Html::encode($member['intro']) ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-success btn-lg px-5 shadow">保存所有修改</button>
            </div>
        <?= Html::endForm() ?>
    </div>

    <div id="display-area" class="row">
        <?php foreach ($members as $member): ?>
            <div class="col-12 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm team-card">
                    <div class="card-body p-4">
                        <div class="row align-items-center mb-3">
                            <div class="col-auto">
                                <img src="<?= Url::to('../../frontend/web/image/our-img/' . $member['img']) ?>"
                                     class="rounded-circle border border-3 border-primary p-1 shadow-sm" 
                                     style="width: 85px; height: 85px; object-fit: cover;">
                            </div>
                            <div class="col">
                                <h4 class="fw-bold mb-1"><?= Html::encode($member['name']) ?></h4>
                                <div class="mb-1">
                                    <span class="badge bg-primary-light text-primary"><?= Html::encode($member['major']) ?></span>
                                </div>
                                <div class="small fw-bold text-muted">
                                    <i data-feather="cpu" class="feather-sm me-1"></i><?= Html::encode($member['role']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="pt-3 border-top">
                            <p class="text-muted mb-0" style="line-height: 1.8; text-align: justify; text-indent: 2em; font-size: 0.95rem;">
                                <?= Html::encode($member['intro']) ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="row mt-4">
        <div class="col-md-7 mb-4">
            <div class="card border-0 shadow-sm h-100 p-4 text-white custom-team-box" 
                 style="background: linear-gradient(135deg, #1e2936 0%, #222e3c 100%) !important;">
                <h3 class="fw-bold mb-3 text-white"><i data-feather="users" class="me-2"></i>关于 <?= Html::encode($info['team_name']) ?></h3>
                <p><?= Html::encode($info['intro']) ?></p>
            </div>
        </div>
        <div class="col-md-5 mb-4">
            <div class="card border-0 shadow-sm h-100 p-4 border-top border-primary border-4">
                <h3 class="fw-bold mb-3 text-primary"><i data-feather="compass" class="me-2"></i><?= Html::encode($info['philosophy_title']) ?></h3>
                <ul class="list-unstyled">
                    <?php foreach ($info['philosophy_items'] as $item): ?>
                        <li class="mb-3 d-flex align-items-start">
                            <i data-feather="check-circle" class="text-success me-2 mt-1" style="width: 18px;"></i>
                            <div>
                                <strong class="d-block"><?= Html::encode($item['title']) ?></strong>
                                <span class="text-muted small"><?= Html::encode($item['desc']) ?></span>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
function toggleEdit() {
    const form = document.getElementById('edit-form');
    form.style.display = (form.style.display === 'none') ? 'block' : 'none';
    if(window.feather) window.feather.replace();
}
</script>

<style>
/* 基础样式 */
.team-card { transition: all 0.3s ease; border: 1px solid rgba(0,0,0,0.05); }
.team-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
.bg-primary-light { background: rgba(59, 93, 231, 0.1); padding: 4px 8px; font-size: 0.75rem; border-radius: 4px; }
.feather-sm { width: 14px; height: 14px; }

.custom-team-box { color: #ffffff !important; }
.custom-team-box p { color: rgba(255, 255, 255, 0.9) !important; line-height: 2; text-align: justify; }

/* 暗黑模式适配 */
body[data-theme="dark"] .bg-primary-light { background: rgba(91, 183, 255, 0.2); color: #5bb7ff !important; }
body[data-theme="dark"] .team-card { background: #222736 !important; border-color: #2e3548; }
body[data-theme="dark"] .team-card h4 { color: #fff !important; }
body[data-theme="dark"] .card:not(.custom-team-box) { background-color: #222736; color: #adb5bd; }
</style>