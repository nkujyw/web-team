<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\QuestionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'content') ?>

    <?= $form->field($model, 'option_a') ?>

    <?= $form->field($model, 'option_b') ?>

    <?= $form->field($model, 'option_c') ?>

    <?php // echo $form->field($model, 'option_d') ?>

    <?php // echo $form->field($model, 'correct_answer') ?>

    <?php // echo $form->field($model, 'related_event_id') ?>

    <?php // echo $form->field($model, 'related_character_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
