<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TrainedModels $model */

$this->title = 'Update Trained Models: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Trained Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="trained-models-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
