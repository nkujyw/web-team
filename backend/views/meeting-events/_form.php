<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MeetingEvents */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="meeting-events-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'meeting_date')->textInput() ?>

    <?= $form->field($model, 'attendees')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'agenda')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
