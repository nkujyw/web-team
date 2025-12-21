
<?php
/**
*Team：方圆双睿
*Coding by 滕一睿 2313109，20251210
*人物表汉化属性/隐藏id
*/
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

       

            [
                'attribute' => 'name',
                'label' => '姓名',
                'headerOptions' => ['style' => 'width: 100px;'], 
            ],

            [
                'attribute' => 'url',
                'label' => '照片',
                'format' => 'raw',
                'value' => function ($model) {
                    
                    if (empty($model->url)) {
                        return '<span class="text-muted">暂无照片</span>';
                    }

             
                    $baseUrl = 'http://localhost/web-team/frontend/web'; 

                
                    return Html::img($baseUrl . $model->url, [
                        'alt' => $model->name,
                        
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
            
      
            [
                'attribute' => 'force_id', 
                'label' => '所属势力',
                
              
                'value' => 'force.name',   
                
            
                'filter' => ArrayHelper::map(Forces::find()->asArray()->all(), 'id', 'name'),
            ],

            
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
