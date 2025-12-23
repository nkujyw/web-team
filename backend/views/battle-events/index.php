<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Forces; 

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\BattleEventsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Battle Events';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="battle-events-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Battle Events', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'force1_id',
            //'force2_id',

            [
                'attribute' => 'force1_id',
                'label' => '势力一',
                'value' => function ($model) {
                    return $model->force1 ? $model->force1->name : '(未设置)';
                },
                'filter' => ArrayHelper::map(Forces::find()->asArray()->all(), 'id', 'name'),
            ],
            [
                'attribute' => 'force2_id',
                'label' => '势力二',
                'value' => function ($model) {
                    return $model->force2 ? $model->force2->name : '(未设置)';
                },
                'filter' => ArrayHelper::map(Forces::find()->asArray()->all(), 'id', 'name'),
            ],
            'casualties',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
