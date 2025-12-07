<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MemWorks */

$this->title = 'Update Mem Works: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mem Works', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mem-works-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
