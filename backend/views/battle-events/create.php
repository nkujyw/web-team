<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BattleEvents */

$this->title = 'Create Battle Events';
$this->params['breadcrumbs'][] = ['label' => 'Battle Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="battle-events-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
