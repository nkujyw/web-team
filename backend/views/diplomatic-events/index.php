<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\DiplomaticEventsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Diplomatic Events';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diplomatic-events-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Diplomatic Events', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'related_force_ids',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
