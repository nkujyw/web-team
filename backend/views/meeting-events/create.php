<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MeetingEvents */

$this->title = 'Create Meeting Events';
$this->params['breadcrumbs'][] = ['label' => 'Meeting Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meeting-events-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
