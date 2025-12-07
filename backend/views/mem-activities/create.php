<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MemActivities */

$this->title = 'Create Mem Activities';
$this->params['breadcrumbs'][] = ['label' => 'Mem Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mem-activities-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
