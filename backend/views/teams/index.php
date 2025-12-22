<?php

/**
*Team：方圆双睿
*Coding by 丛方昊 2310682
*队伍汉化属性/隐藏id
*/

use common\models\Forces;
use common\models\Characters; // 引入人物模型（为了显示队长名字）
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

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
            

            [
                'attribute' => 'force_id',
                'label' => '所属势力',
                'value' => 'force.name', // 确保 Teams 模型里有 getForce()
                'filter' => ArrayHelper::map(Forces::find()->asArray()->all(), 'id', 'name'),
            ],

            [
                'attribute' => 'leader_id',
                'label' => '队长/领导人',
                'value' => function($model) {
                    // 确保 Teams 模型里有 getLeader() 
                    return $model->leader ? $model->leader->name : '无';
                },

                 'filter' => ArrayHelper::map(Characters::find()->asArray()->all(), 'id', 'name'),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>