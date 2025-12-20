<?php
$this->title = '首页 - 数据概览';
?>

<div class="container-fluid p-0">

    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h1 class="page-header-title">数据控制台</h1>
                    <p class="page-sub-title">欢迎回来，查看抗战胜利80周年项目的数据进展。</p>
                </div>
                <div>
                    <a href="#" class="btn btn-primary shadow-sm"><i class="align-middle" data-feather="download"></i> 导出报表</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <h5 class="card-title text-muted mb-2">人物收录</h5>
                            <h2 class="stat-value mt-1 mb-0">1,204</h2>
                        </div>
                        <div class="stat-icon-box bg-light-primary">
                            <i class="align-middle" data-feather="user"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="badge bg-light-primary text-primary"> +5.25% </span>
                        <span class="text-muted small ms-1">较上周</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <h5 class="card-title text-muted mb-2">战役记录</h5>
                            <h2 class="stat-value mt-1 mb-0">35</h2>
                        </div>
                        <div class="stat-icon-box bg-light-danger">
                            <i class="align-middle" data-feather="crosshair"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="badge bg-light-success text-success"> +2 </span>
                        <span class="text-muted small ms-1">本月新增</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <h5 class="card-title text-muted mb-2">访客统计</h5>
                            <h2 class="stat-value mt-1 mb-0">14.2k</h2>
                        </div>
                        <div class="stat-icon-box bg-light-success">
                            <i class="align-middle" data-feather="users"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="badge bg-light-success text-success"> +6.65% </span>
                        <span class="text-muted small ms-1">最近7天</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <h5 class="card-title text-muted mb-2">未读留言</h5>
                            <h2 class="stat-value mt-1 mb-0">64</h2>
                        </div>
                        <div class="stat-icon-box bg-light-warning">
                            <i class="align-middle" data-feather="message-square"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="badge bg-light-danger text-danger"> -2.25% </span>
                        <span class="text-muted small ms-1">较昨日</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8">
            <div class="card flex-fill w-100">
                <div class="card-header border-0 pb-0">
                    <h5 class="card-title mb-0">近期流量趋势</h5>
                </div>
                <div class="card-body py-3">
                    <div class="chart chart-sm" style="height: 300px;">
                        <canvas id="chartjs-dashboard-line"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4">
             <div class="card flex-fill w-100">
                <div class="card-header border-0 pb-0">
                    <h5 class="card-title mb-0">浏览器分布</h5>
                </div>
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                        <div class="py-3">
                            <div class="chart chart-xs" style="height: 300px;">
                                <canvas id="chartjs-dashboard-pie"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
$script = <<< JS
document.addEventListener("DOMContentLoaded", function() {
    // 重新初始化图标
    if(window.feather) feather.replace();

    var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
    var gradient = ctx.createLinearGradient(0, 0, 0, 225);
    // 使用你的主题色，这里假设 window.theme.primary 是蓝色
    // 如果没有 window.theme 变量，直接写 '#3b5de7'
    var primaryColor = window.theme && window.theme.primary ? window.theme.primary : '#3b5de7';
    
    gradient.addColorStop(0, "rgba(59, 93, 231, 0.25)"); // 增加透明度，更有质感
    gradient.addColorStop(1, "rgba(59, 93, 231, 0)");
    
    // 1. 优化折线图
    new Chart(document.getElementById("chartjs-dashboard-line"), {
        type: "line",
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "访问量",
                fill: true,
                backgroundColor: gradient,
                borderColor: primaryColor,
                borderWidth: 2, // 线条稍微变细一点，精致
                tension: 0.4,   // 关键：贝塞尔曲线，让线条变弯曲
                pointRadius: 0, // 默认隐藏点
                pointHoverRadius: 6, // 悬停时显示大点
                data: [2115, 1562, 1584, 1892, 1587, 1923, 2566, 2448, 2805, 3438, 2917, 3327]
            }]
        },
        options: {
            maintainAspectRatio: false,
            legend: { display: false },
            tooltips: {
                intersect: false,
                mode: 'index', // 鼠标在x轴任何位置都显示
                backgroundColor: 'rgba(0,0,0, 0.8)',
                titleFontColor: '#fff',
                bodyFontColor: '#fff',
                cornerRadius: 4
            },
            hover: { intersect: true },
            plugins: { filler: { propagate: false } },
            scales: {
                xAxes: [{ 
                    reverse: true, 
                    gridLines: { color: "rgba(0,0,0,0.0)" },
                    ticks: { fontColor: '#9aa0ac' } 
                }],
                yAxes: [{ 
                    ticks: { stepSize: 1000, fontColor: '#9aa0ac' }, 
                    display: true, 
                    borderDash: [5, 5], // 虚线风格
                    gridLines: { color: "rgba(0,0,0,0.03)", drawBorder: false } 
                }]
            }
        }
    });

    // 2. 优化饼图
    new Chart(document.getElementById("chartjs-dashboard-pie"), {
        type: "doughnut", // 改成甜甜圈图，比纯饼图更现代
        data: {
            labels: ["Chrome", "Firefox", "IE"],
            datasets: [{
                data: [4306, 3801, 1689],
                backgroundColor: [ primaryColor, "#f1b44c", "#f46a6a" ], // 使用更和谐的颜色组合
                borderWidth: 0, // 去掉边框
                hoverBorderWidth: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: { 
                position: 'bottom',
                labels: { usePointStyle: true, padding: 20 } // 底部图例，圆点风格
            }, 
            cutoutPercentage: 70 // 中间空心大一点
        }
    });
});
JS;
$this->registerJs($script);
?>