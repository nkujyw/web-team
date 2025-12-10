<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BattleEvents */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="battle-events-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'force1_id')->textInput() ?>

    <?= $form->field($model, 'force2_id')->textInput() ?>

    <?= $form->field($model, 'casualties')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
