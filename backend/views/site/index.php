<?php
$this->title = '数据控制台 - 抗战 80 周年纪念项目';
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
                    <div class="mb-0"><span class="text-muted">今日新增留言需处理</span></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-header"><h5 class="card-title mb-0">抗战历史事件时间线 (按年统计)</h5></div>
                <div class="card-body py-3">
                    <div class="chart chart-sm"><canvas id="chartjs-dashboard-line"></canvas></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-header"><h5 class="card-title mb-0">事件类型占比</h5></div>
                <div class="card-body d-flex"><div class="align-self-center w-100"><div class="py-3 chart-pie"><canvas id="chartjs-dashboard-pie"></canvas></div></div></div>
            </div>
        </div>
    </div>
</div>

<?php
// 处理图表 JS 数据
$lineLabels = json_encode(array_column($eventData, 'year'));
$lineValues = json_encode(array_column($eventData, 'count'));

$pieLabels = json_encode(array_column($typeData, 'event_type'));
$pieValues = json_encode(array_column($typeData, 'count'));

$script = <<< JS
document.addEventListener("DOMContentLoaded", function() {
    // 1. 折线图
    new Chart(document.getElementById("chartjs-dashboard-line"), {
        type: "line",
        data: {
            labels: $lineLabels,
            datasets: [{
                label: "事件数量",
                fill: true,
                backgroundColor: "rgba(59, 93, 231, 0.1)",
                borderColor: "#3b5de7",
                data: $lineValues,
                tension: 0.4
            }]
        },
        options: { maintainAspectRatio: false }
    });

    // 2. 饼图
    new Chart(document.getElementById("chartjs-dashboard-pie"), {
        type: "doughnut",
        data: {
            labels: $pieLabels,
            datasets: [{
                data: $pieValues,
                backgroundColor: ["#3b5de7", "#f1b44c", "#f46a6a", "#2dce89"],
                borderWidth: 5
            }]
        },
        options: { maintainAspectRatio: false, cutoutPercentage: 70 }
    });
});
JS;
$this->registerJs($script);
?>