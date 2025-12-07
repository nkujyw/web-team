<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Forces */

$this->title = 'Create Forces';
$this->params['breadcrumbs'][] = ['label' => 'Forces', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forces-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
