<?php

/**
*Team：方圆双睿
*Coding by 丛方昊 2310682
*纪念活动汉化属性/隐藏id/展示图片
*/

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

    <?php ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        // 'id',
        'name',
        'activity_date',
        

        [
            'attribute' => 'location_id',
            'label' => '地点',
            'value' => function($model) {
                return $model->location ? $model->location->name : '未知';
            }
        ],

        'organizer',
        

        [
            'attribute' => 'photo_url',
            'label' => '活动图片',
            'format' => 'raw',
            'value' => function ($model) {
                if (empty($model->photo_url)) {
                    return '<span class="text-muted">暂无图片</span>';
                }
                $baseUrl = 'http://localhost/web-team/frontend/web'; 
                
                return Html::img($baseUrl . $model->photo_url, [
                    'alt' => $model->name,
                    'style' => 'width: 100px; height: 80px; object-fit: cover; border-radius: 4px;',
                    'class' => 'img-thumbnail',
                    'title' => '点击查看大图',
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
