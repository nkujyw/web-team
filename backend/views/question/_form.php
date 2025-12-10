<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Question */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'option_a')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'option_b')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'option_c')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'option_d')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'correct_answer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'related_event_id')->textInput() ?>

    <?= $form->field($model, 'related_character_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
