<?php
/**
 * important_battle.php
 * 重大战役纪实视图文件
 * 处理展示卢沟桥事变、淞沪会战等重要战役的详细信息，用于首页跳转。
 * @author 吉圆伟
 * @date 2025-12-16
*/
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Events */

$this->title = $model->name . ' - 战役纪实';

// 数据库里没有的“指挥官”和“兵力”信息，处理保留在数组里
$battleStats = [
    // 1. 卢沟桥事变
    1 => [
        'commander_cn' => '宋哲元、吉星文',
        'commander_jp' => '田代皖一郎、牟田口廉也',
        'strength'     => '中方：第29军<br>日方：中国驻屯军',
    ],
    // 2. 淞沪会战
    2 => [
        'commander_cn' => '蒋介石、冯玉祥、张治中',
        'commander_jp' => '松井石根、柳川平助',
        'strength'     => '中方：约 75 万人<br>日方：约 35 万人',
    ],
    // 7. 太原会战
    7 => [
        'commander_cn' => '阎锡山、卫立煌、朱德',
        'commander_jp' => '寺内寿一、板垣征四郎',
        'strength'     => '中方：约 28 万人<br>日方：约 14 万人',
    ],
];

// 获取扩展数据
$stats = isset($battleStats[$model->id]) ? $battleStats[$model->id] : [
    'commander_cn' => '待补充', 'commander_jp' => '待补充', 
    'strength' => '统计中'
];
?>

<div class="event-view" style="background-color: #f5f5f5; min-height: 100vh; padding-bottom: 50px;">
    <div class="container">
        
        <nav aria-label="breadcrumb" style="padding-top: 20px;">
            <ol class="breadcrumb" style="background: none; padding-left: 0;">
                <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>" class="text-danger">首页</a></li>
                <li class="breadcrumb-item"><a href="<?= Url::to(['event/index']) ?>" class="text-danger">抗战时间轴</a></li>
                <li class="breadcrumb-item active" aria-current="page">战役详情</li>
            </ol>
        </nav>

        <div class="card shadow border-0 mb-5">
            <div class="card-body p-0">
                
                <div class="text-center bg-white p-5" style="border-bottom: 1px solid #eee;">
                    <div style="width: 60px; height: 4px; background: #B71C1C; margin: 0 auto 20px;"></div>
                    <h1 style="font-family: 'SimHei', serif; color: #333; font-weight: bold; margin-bottom: 15px;">
                        <?= Html::encode($model->name) ?>
                    </h1>
                    <div class="text-muted small">
                        <span class="mr-4"><i class="fa fa-clock-o"></i> 爆发时间：<?= $model->start_date ?></span>
                        <span class="mr-4"><i class="fa fa-map-marker"></i> 地点：<?php echo Html::encode($model->location ? $model->location->name : '未知地点'); ?></span>
                        <span class="badge badge-danger">重大战役</span>
                    </div>
                </div>

                <div class="row no-gutters">
                    
                    <div class="col-lg-8 border-right">
                        <div class="p-5">
                            <?php
                                $imgName = 'battle.jpg'; 
                                switch ($model->id) {
                                    case 1: $imgName = 'luGouQiao.png'; break;
                                    case 2: $imgName = 'songHu.png'; break;
                                    case 7: $imgName = 'taiYuan.png'; break;
                                }
                                $imgPath = 'image/index-images/' . $imgName;
                                if (!file_exists(Yii::getAlias('@webroot/') . $imgPath)) {
                                    $imgPath = 'image/index-images/battle.jpg';
                                }
                            ?>
                            <div class="text-center mb-4">
                                <img src="<?= Url::to('@web/' . $imgPath) ?>" class="img-fluid rounded shadow-sm" style="width: 100%;">
                            </div>

                            <div class="event-content" style="font-size: 18px; line-height: 2; color: #333; text-align: justify;">
                                <h4 class="font-weight-bold mb-3" style="border-left: 4px solid #B71C1C; padding-left: 10px;">战役经过</h4>
                                <?= nl2br(Html::encode($model->description)) ?>
                            </div>

                            <div class="mt-5 p-4" style="background: #fff8f8; border-radius: 5px; border: 1px dashed #ebb;">
                                <h5 class="text-danger font-weight-bold"><i class="fa fa-history"></i> 最终结果</h5>
                                <p class="mb-0 small text-secondary" style="line-height: 1.8; font-size: 16px;">
                                    <?= Html::encode($model->significance) ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 bg-light">
                        <div class="p-4">
                            <h5 class="font-weight-bold mb-4" style="color: #555;">
                                <i class="fa fa-folder-open-o"></i> 战役档案
                            </h5>
                            
                            <ul class="list-group list-group-flush shadow-sm rounded" style="font-size: 14px;">
                                <li class="list-group-item bg-white">
                                    <strong class="d-block text-secondary mb-1">参战方（中方）</strong>
                                    <span class="text-dark"><?= $stats['commander_cn'] ?></span>
                                </li>
                                <li class="list-group-item bg-white">
                                    <strong class="d-block text-secondary mb-1">参战方（日方）</strong>
                                    <span class="text-dark"><?= $stats['commander_jp'] ?></span>
                                </li>
                                <li class="list-group-item bg-white">
                                    <strong class="d-block text-secondary mb-1">兵力对比</strong>
                                    <span class="text-dark"><?= $stats['strength'] ?></span>
                                </li>
                                <li class="list-group-item bg-white">
                                    <strong class="d-block text-secondary mb-1">伤亡情况</strong>
                                    <span class="text-danger font-weight-bold">
                                        <?php 
                                            $battleData = null;
                                            if ($model->canGetProperty('battleEvents')) {
                                                $battleData = $model->battleEvents;
                                            } elseif ($model->canGetProperty('battleEvent')) {
                                                $battleData = $model->battleEvent;
                                            }

                                            echo Html::encode($battleData ? $battleData->casualties : '暂无数据'); 
                                        ?>
                                    </span>
                                </li>
                            </ul>
                            
                            <?php 
                                $mapPath = 'image/events/map_' . $model->id . '.jpg';
                                if (file_exists(Yii::getAlias('@webroot/') . $mapPath)): 
                            ?>
                                <div class="mt-4">
                                    <h6 class="font-weight-bold text-secondary mb-2">作战态势图</h6>
                                    <div class="shadow-sm rounded overflow-hidden">
                                        <img src="<?= Url::to('@web/' . $mapPath) ?>" style="width: 100%; height: auto;">
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>

                </div>
            </div>
            
            <div class="card-footer bg-white text-center border-top pb-5 pt-4">
                <a href="<?= Url::to(['site/index']) ?>" class="btn btn-outline-secondary px-4 mr-2">返回首页</a>
            </div>
        </div>
    </div>
</div>