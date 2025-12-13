<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\MemWorksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mem Works';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mem-works-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mem Works', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        // 'id', // 已隐藏 ID
        
        'name', 
        'type',
        'author',
        'create_date',
        
        [
            'attribute' => 'url',
            'label' => '作品展示', // 自定义表头
            'format' => 'raw',     // 必须设置为 raw 才能解析 HTML 图片标签
            'value' => function ($model) {
                // 1. 判空处理
                if (empty($model->url)) {
                    return '<span class="text-muted">暂无图片</span>';
                }

                // 2. 定义基础路径
                $baseUrl = 'http://localhost/web-team/frontend/web'; 
                

                // 3. 生成图片标签
                return Html::img($baseUrl . $model->url, [
                    'alt' => $model->name,
                    'style' => 'width: 100px; height: 80px; object-fit: cover; border-radius: 4px;', // 限制大小，保持美观
                    'class' => 'img-thumbnail', // 加一个边框样式
                    'title' => '点击查看大图',
                    // 可选：点击在新窗口打开大图
                    'onclick' => 'window.open("' . $baseUrl . $model->url . '")',
                    'style' => 'cursor:pointer; width:100px;' 
                ]);
            },
            'contentOptions' => ['style' => 'text-align: center; vertical-align: middle; width: 120px;'], 
        ],

        [
            'attribute' => 'related_event_id',
            'label' => '关联事件',
            'value' => function($model) {
                return $model->relatedEvent ? $model->relatedEvent->name : '无';
            },
        ],

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>


</div>
