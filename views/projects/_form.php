<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Projects $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="projects-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if (Yii::$app->getUser()->identity->role === 'admin'): ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'price')->textInput() ?>

        <?= $form->field($model, 'location_text')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'latitude')->textInput() ?>

        <?= $form->field($model, 'longitude')->textInput() ?>

        <?= $form->field($model, 'moderator_status')->dropDownList(\app\helpers\Status::MODERATOR_PROJECT_STATUS) ?>

        <?= $form->field($model, 'moderator_status_setter_id')->textInput([
            'value' => Yii::$app->getUser()->id,
            'disabled' => true
        ]);
        ?>

    <?php endif; ?>

    <?= $form->field($model, 'citizen_status')->dropDownList(\app\helpers\Status::CITIZEN_PROJECT_STATUS) ?>

    <?= $form->field($model, 'citizen_status_setter_id')->textInput([
        'value' => Yii::$app->getUser()->id,
        'disabled' => true
    ]);
    ?>

    <div class="form-group mt-3">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
