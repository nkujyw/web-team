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

            //'id',
            'name',
            'type',
            'author',
            'create_date',
            //'description:ntext',
            //'url:url',
            [
                'attribute' => 'url',
                'label' => '作品图片',
                'format' => 'html',
                'value' => function($model) {
                    if (!empty($model->url)) {
                        // 使用完整的URL路径
                        $imageUrl = '/image' . $model->url;
                        
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
            //'related_event_id',
            //'related_character_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
