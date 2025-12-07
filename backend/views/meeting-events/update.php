<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MeetingEvents */

$this->title = 'Update Meeting Events: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Meeting Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="meeting-events-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
