<?php
/**
*Team：方圆双睿
*Coding by 滕一睿 2313109，20251210
*势力表汉化属性/隐藏id
*/
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ForcesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '势力';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forces-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('新增势力', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            [
                'attribute' => 'name',
                'label' => '势力名称',
            ],

            
            [
                'attribute' => 'type',
                'label' => '势力类型',   
            ],


            
            [
                'attribute' => 'description',
                'label' => '势力简介',
                'format' => 'ntext',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
