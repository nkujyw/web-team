<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\LocationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '地点';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="locations-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('新增地点', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',

            [
                'attribute' => 'name',
                'label' => '地点名称',
            ],
            [
                'attribute' => 'type',
                'label' => '地点类型',
            ],
            [
                'attribute' => 'description',
                'label' => '地点描述',
                'format' => 'ntext',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
