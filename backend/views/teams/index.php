<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TeamsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Teams';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teams-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Teams', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'name',
            'founded_date',
            'description:ntext',
            //'force_id',
            [
                'attribute' => 'force_id',
                'label' => '所属势力',
                'value' => function($model) {
                    return $model->force ? $model->force->name : '未知';
                }
            ],
            //'leader_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
