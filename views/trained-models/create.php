<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TrainedModels $model */

$this->title = 'Create Trained Models';
$this->params['breadcrumbs'][] = ['label' => 'Trained Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trained-models-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
