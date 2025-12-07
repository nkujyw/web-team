<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DiplomaticEvents */

$this->title = 'Create Diplomatic Events';
$this->params['breadcrumbs'][] = ['label' => 'Diplomatic Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diplomatic-events-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
