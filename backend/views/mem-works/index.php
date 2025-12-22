<?php

/**
*Team：方圆双睿
*Coding by 丛方昊 2310682
*纪念作品汉化属性/隐藏id/展示图片
*/

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

    <?php ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        // 'id',
        
        'name', 
        'type',
        'author',
        'create_date',
        
        [
            'attribute' => 'url',
            'label' => '作品展示',
            'format' => 'raw',
            'value' => function ($model) {
                if (empty($model->url)) {
                    return '<span class="text-muted">暂无图片</span>';
                }

                $baseUrl = 'http://localhost/web-team/frontend/web'; 
                
                return Html::img($baseUrl . $model->url, [
                    'alt' => $model->name,
                    'style' => 'width: 100px; height: 80px; object-fit: cover; border-radius: 4px;',
                    'class' => 'img-thumbnail',
                    'title' => '点击查看大图',
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
