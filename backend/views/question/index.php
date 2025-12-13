<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\QuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Questions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Question', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'content:ntext',
            'option_a',
            'option_b',
            'option_c',
            'option_d',
            'correct_answer',
            //'related_event_id',
            //'related_character_id',


        [
            'attribute' => 'related_event_id',
            'value' => function ($model) {
                // 使用匿名函数更安全，防止关联数据为空时报错
                return $model->relatedEvent ? $model->relatedEvent->name : '无';
            },
            'label' => '关联事件',
        ],
        [
            'attribute' => 'related_character_id',
            'value' => function ($model) {
                return $model->relatedCharacter ? $model->relatedCharacter->name : '无';
            },
            'label' => '关联人物',
        ],


        ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
