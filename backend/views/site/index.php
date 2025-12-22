<?php
/**
 * 数据控制台首页
 * 显示关键统计数据和图表
 * @author: 2311786 吉圆伟
 * @date: 2025-12-20
 */
use yii\helpers\Url;

$this->title = '数据控制台 - 抗战 80 周年纪念项目';

/** * 1. 引入 Chart.js 库
 */
$this->registerJsFile('https://lib.baomitu.com/Chart.js/2.9.4/Chart.min.js', ['position' => \yii\web\View::POS_HEAD]);

// 映射数据库英文类型到中文
$typeMap = [
    'battle' => '战役/战斗',
    'diplomatic' => '外交事件',
    'meeting' => '重要会议'
];

// 处理数据
$lineLabels = json_encode(array_column($eventData, 'year') ?: []);
$lineValues = json_encode(array_column($eventData, 'count') ?: []);

$processedPieLabels = array_map(function($type) use ($typeMap) {
    return $typeMap[$type] ?? $type;
}, array_column($typeData, 'event_type') ?: []);

$pieLabels = json_encode($processedPieLabels);
$pieValues = json_encode(array_column($typeData, 'count') ?: []);
?>

<div class="container-fluid p-0">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-3"><strong>数据概览</strong> 仪表盘</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0"><h5 class="card-title">人物收录</h5></div>
                        <div class="col-auto"><div class="stat text-primary"><i class="align-middle" data-feather="users"></i></div></div>
                    </div>
                    <h1 class="mt-1 mb-3"><?= number_format($stats['charCount']) ?></h1>
                    <div class="mb-0"><span class="text-muted">已入库英雄人物总数</span></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0"><h5 class="card-title">战役记录</h5></div>
                        <div class="col-auto"><div class="stat text-danger"><i class="align-middle" data-feather="crosshair"></i></div></div>
                    </div>
                    <h1 class="mt-1 mb-3"><?= $stats['battleCount'] ?></h1>
                    <div class="mb-0"><span class="text-muted">历史重大战役及规模</span></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0"><h5 class="card-title">纪念作品</h5></div>
                        <div class="col-auto"><div class="stat text-success"><i class="align-middle" data-feather="book"></i></div></div>
                    </div>
                    <h1 class="mt-1 mb-3"><?= $stats['workCount'] ?></h1>
                    <div class="mb-0"><span class="text-muted">文学、影视及艺术品</span></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0"><h5 class="card-title">互动留言</h5></div>
                        <div class="col-auto"><div class="stat text-warning"><i class="align-middle" data-feather="message-square"></i></div></div>
                    </div>
                    <h1 class="mt-1 mb-3"><?= $stats['msgCount'] ?></h1>
                    <div class="mb-0"><span class="text-muted">累计收录访客感言</span></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-header"><h5 class="card-title mb-0">抗战历史事件时间线 (按年统计)</h5></div>
                <div class="card-body py-3">
                    <div class="chart chart-sm" style="height: 300px;">
                        <canvas id="chartjs-dashboard-line"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-header"><h5 class="card-title mb-0">事件类型占比</h5></div>
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                        <div class="py-3 chart-pie" style="height: 300px;">
                            <canvas id="chartjs-dashboard-pie"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
/**
 * 3. 绘图脚本
 */
$script = <<< JS
window.onload = function() {
    if (typeof Chart === 'undefined') {
        console.error("Chart.js 未能加载，请检查网络或 CDN 链接。");
        return;
    }

    // 绘制柱状图
    var ctxLine = document.getElementById("chartjs-dashboard-line");
    if (ctxLine) {
        new Chart(ctxLine, {
            type: "bar",
            data: {
                labels: $lineLabels,
                datasets: [{
                    label: "事件数量",
                    backgroundColor: "#3b7ddd",
                    data: $lineValues
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: { yAxes: [{ ticks: { beginAtZero: true, stepSize: 1 } }] }
            }
        });
    }

    // 绘制饼图
    var ctxPie = document.getElementById("chartjs-dashboard-pie");
    if (ctxPie) {
        new Chart(ctxPie, {
            type: "pie",
            data: {
                labels: $pieLabels,
                datasets: [{
                    data: $pieValues,
                    backgroundColor: ["#f46a6a", "#3b5de7", "#f1b44c", "#2dce89"],
                    borderWidth: 2
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: { display: true, position: 'bottom' }
            }
        });
    }
};
JS;
$this->registerJs($script, \yii\web\View::POS_END);
?>