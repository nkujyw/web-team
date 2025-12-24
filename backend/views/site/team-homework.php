<?php
/**
 * 团队作业下载页面
 * 提供各类交付物的直接下载链接
 * @author: 2311786 吉圆伟
 * @date: 2025-12-22
 */
use yii\helpers\Url; 
use yii\helpers\Html;

$this->title = '团队作业下载';

// 定义统一的后缀和前缀
$suffix = '(2311786_2312478_2310682_2313109)';
$prefix = '方圆双睿_';
$githubUrl = 'https://github.com/nkujyw/web-team';

$items = [
    ['name' => '需求文档',   'icon' => 'file-text',  'file' => $prefix . '需求文档' . $suffix . '.pdf'],
    ['name' => '设计文档',   'icon' => 'layers',     'file' => $prefix . '设计文档' . $suffix . '.pdf'],
    ['name' => '实现文档',   'icon' => 'code',       'file' => $prefix . '实现文档' . $suffix . '.pdf'],
    ['name' => '用户手册',   'icon' => 'book-open',  'file' => $prefix . '用户手册' . $suffix . '.pdf'],
    ['name' => '项目展示PPT', 'icon' => 'tv',        'file' => $prefix . '项目展示' . $suffix . '.pptx'],
    ['name' => '部署文档',   'icon' => 'server',     'file' => $prefix . '部署文档' . $suffix . '.pdf'],
    ['name' => '录屏讲解',   'icon' => 'video',      'file' => $prefix . '录屏讲解' . $suffix . '.mp4'],
    ['name' => '数据库文件', 'icon' => 'database',   'file' => 'install.sql', 'is_db' => true],
];
?>

<div class="container-fluid p-0">
    <div class="d-flex align-items-center py-2 px-3 shadow-sm border" 
        style="border-radius: 8px; background-color: #f8f9fa;">
        <i data-feather="github" class="me-2 text-dark" style="width: 18px; height: 18px;"></i>
            <span class="me-2 fw-bold text-dark" style="color: #000 !important;">源代码仓库:</span>
                <a href="<?= $githubUrl ?>" target="_blank" class="text-primary text-decoration-none fw-semibold">
                    <?= $githubUrl ?> <i data-feather="external-link" style="width: 14px;"></i>
                </a>
    </div>

    <div class="row">
        <?php foreach ($items as $item): 
            $downloadUrl = Url::to([
                'site/download', 
                'type' => isset($item['is_db']) ? 'db' : 'team', 
                'file' => $item['file']
            ]);
        ?>
            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <div class="card shadow-sm h-100 border-0" style="background: #222e3c;">
                    <div class="card-body text-center d-flex flex-column justify-content-between p-4">
                        <div>
                            <div class="mb-3">
                                <i class="text-primary" data-feather="<?= $item['icon'] ?>" style="width: 48px; height: 48px;"></i>
                            </div>
                            <h5 class="card-title mb-3 text-white"><?= Html::encode($item['name']) ?></h5>
                        </div>
                        <a href="<?= $downloadUrl ?>" class="btn btn-primary btn-sm w-100">直接下载</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>