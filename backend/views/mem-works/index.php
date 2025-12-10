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

            'id',
            'name',
            'type',
            'author',
            'create_date',
            //'description:ntext',
            //'url:url',
            //'related_event_id',
            //'related_character_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
