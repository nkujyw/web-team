<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\MemActivitiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mem Activities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mem-activities-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mem Activities', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        // 'id', // 已隐藏 ID
        'name',
        'activity_date',
        

        [
            'attribute' => 'location_id',
            'label' => '地点',
            'value' => function($model) {
                // 确保你的 MemActivities 模型里有 getLocation() 方法
                return $model->location ? $model->location->name : '未知';
            }
        ],

        'organizer',
        

        [
            'attribute' => 'photo_url', // 数据库字段名为 photo_url
            'label' => '活动图片',      // 自定义表头
            'format' => 'raw',          // 必须为 raw
            'value' => function ($model) {
                // 1. 判空处理
                if (empty($model->photo_url)) {
                    return '<span class="text-muted">暂无图片</span>';
                }

                // 2. 定义基础路径 (根据你的要求，注意端口)
                // 如果你的项目需要 :8080 端口，请确保下面加上 :8080
                $baseUrl = 'http://localhost/web-team/frontend/web'; 
                
                // 3. 生成图片标签
                return Html::img($baseUrl . $model->photo_url, [
                    'alt' => $model->name,
                    'style' => 'width: 100px; height: 80px; object-fit: cover; border-radius: 4px;', // 样式保持一致
                    'class' => 'img-thumbnail',
                    'title' => '点击查看大图',
                    // 点击在新窗口打开
                    'onclick' => 'window.open("' . $baseUrl . $model->photo_url . '")',
                    'style' => 'cursor:pointer; width:100px;' 
                ]);
            },
            'contentOptions' => ['style' => 'text-align: center; vertical-align: middle; width: 120px;'], 
        ],

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>


</div>
