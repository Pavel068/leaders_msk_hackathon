<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Queue $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="queue-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'file_id')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'new' => 'Новая', 'processing' => 'Обработка', 'completed' => 'Завершено', 'failed' => 'Ошибка', ], ['prompt' => '']) ?>


    <div class="form-group mt-3">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
