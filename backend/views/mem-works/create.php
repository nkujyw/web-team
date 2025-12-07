<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MemWorks */

$this->title = 'Create Mem Works';
$this->params['breadcrumbs'][] = ['label' => 'Mem Works', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mem-works-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
