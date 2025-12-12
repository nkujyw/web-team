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

            //'id',
            'name',
            'activity_date',
            //'location_id',
            [
                'attribute' => 'location_id',
                'label' => '地点',
                'value' => function($model) {
                    return $model->location ? $model->location->name : '未知';
                }
            ],
            'organizer',
            //'description:ntext',
            //'photo_url:url',
            [
                'attribute' => 'photo_url',
                'label' => '活动图片',
                'format' => 'html',
                'value' => function($model) {
                    if (!empty($model->photo_url)) {
                        $baseUrl = 'http://localhost:8080/web-team/frontend/web';
                        $imageUrl = $baseUrl . $model->photo_url;
                        
                        return Html::img($imageUrl, [
                            'style' => 'max-width: 100px; max-height: 100px; object-fit: cover;',
                            'class' => 'img-thumbnail',
                            'alt' => $model->name,
                            'title' => '点击查看大图',
                            'onclick' => "window.open('" . $imageUrl . "', '_blank')",
                            'onerror' => "this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9IiNmNWY1ZjUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHJlY3Qgd2lkdGg9IjEwMCIgaGVpZ2h0PSIxMDAiIHJ4PSIyIiByeT0iMiIvPjx0ZXh0IHg9IjUwJSIgeT0iNTAlIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTAiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGFsaWdubWVudC1iYXNlbGluZT0ibWlkZGxlIiBmaWxsPSIjY2NjIj7lm77niYc8L3RleHQ+PC9zdmc+'"
                        ]);
                    }
                    return '<span class="text-muted">无图片</span>';
                },
                'contentOptions' => ['style' => 'text-align: center;'],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
