<?php

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

            // 'id',

            [
                'attribute' => 'name',
                'label' => '姓名',
            ],
            [
                'attribute' => 'biography',
                'label' => '人物简介',
                'format' => 'ntext',
            ],
            [
                'label' => '所属势力',
                'value' => function ($model) {
                    return $model->forceName;
                }
            ],
            [
                'attribute' => 'achievements',
                'label' => '主要事迹',
                'format' => 'ntext',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
