<?php

use yii\helpers\ArrayHelper;
use common\models\Forces; 
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CharactersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '人物';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="characters-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('新增人物', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id', // 已隐藏

            [
                'attribute' => 'name',
                'label' => '姓名',
                'headerOptions' => ['style' => 'width: 100px;'], // 稍微限制一下姓名的宽度
            ],

            [
                'attribute' => 'url',
                'label' => '照片',
                'format' => 'raw',
                'value' => function ($model) {
                    // 1. 判空
                    if (empty($model->url)) {
                        return '<span class="text-muted">暂无照片</span>';
                    }

                    // 2. 基础路径 (和你之前的一样)
                    $baseUrl = 'http://localhost/web-team/frontend/web'; 

                    // 3. 生成图片
                    return Html::img($baseUrl . $model->url, [
                        'alt' => $model->name,
                        // 人物照建议稍微窄一点，高一点 (80x100)
                        'style' => 'width: 80px; height: 100px; object-fit: cover; border-radius: 4px; cursor: pointer;', 
                        'class' => 'img-thumbnail',
                        'title' => '点击查看大图',
                        'onclick' => 'window.open("' . $baseUrl . $model->url . '")',
                    ]);
                },
                'contentOptions' => ['style' => 'text-align: center; vertical-align: middle; width: 100px;'], 
            ],

            [
                'attribute' => 'rank',
                'label' => '职务',
                'headerOptions' => ['style' => 'width: 100px;'],
            ],

            [
                'attribute' => 'biography',
                'label' => '人物简介',
                'format' => 'ntext',
                'contentOptions' => ['style' => 'max-width: 300px; white-space: normal;'], // 防止文字太长撑开表格
            ],
            
            // --- 修正部分开始 ---
            [
                'attribute' => 'force_id', 
                'label' => '所属势力',
                
                // 显示内容：自动通过 getForce() 关联获取 name
                'value' => 'force.name',   
                
                // 【高级功能】把输入框变成下拉菜单
                'filter' => ArrayHelper::map(Forces::find()->asArray()->all(), 'id', 'name'),
            ],
            // --- 修正部分结束 ---
            
            [
                'attribute' => 'achievements',
                'label' => '主要事迹',
                'format' => 'ntext',
                'contentOptions' => ['style' => 'max-width: 300px; white-space: normal;'],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>