<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Projects $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="projects-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'location_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'latitude')->textInput() ?>

    <?= $form->field($model, 'longitude')->textInput() ?>

    <?= $form->field($model, 'moderator_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'moderator_status_setter_id')->textInput() ?>

    <?= $form->field($model, 'citizen_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'citizen_status_setter_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
