<?php
use yii\helpers\Url; // 必须引入
$this->title = '团队作业下载';

$items = [
    ['name' => '需求文档', 'icon' => 'file-text', 'file' => '需求文档.pdf'],
    ['name' => '设计文档', 'icon' => 'layers',    'file' => '设计文档.pdf'],
    ['name' => '实现文档', 'icon' => 'code',      'file' => '实现文档.pdf'],
    ['name' => '用户手册', 'icon' => 'book-open',  'file' => '用户手册.pdf'],
    ['name' => '项目展示PPT', 'icon' => 'tv',     'file' => '项目展示.pptx'],
    ['name' => '源代码',   'icon' => 'github',    'file' => 'source_code.zip'],
    ['name' => '数据库文件', 'icon' => 'database', 'file' => 'anti_war_db.sql', 'is_db' => true],
    ['name' => '部署文档', 'icon' => 'server',    'file' => '部署说明.docx'],
];
?>

<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>团队作业</strong> 交付物清单</h1>
    <div class="row">
        <?php foreach ($items as $item): 
            // 如果是数据库，直接去 data/ 下找；否则去 data/team/ 下找
            $downloadUrl = Url::to([
                'site/download', 
                'type' => isset($item['is_db']) ? 'db' : 'team', 
                'file' => $item['file']
            ]);
        ?>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <div class="mb-3"><i class="text-primary" data-feather="<?= $item['icon'] ?>" style="width: 48px; height: 48px;"></i></div>
                        <h5 class="card-title"><?= $item['name'] ?></h5>
                        <a href="<?= $downloadUrl ?>" class="btn btn-primary btn-sm">直接下载</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>