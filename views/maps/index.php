<?php

use yii\helpers\Html;
use stalkerrr\yandex_map\YandexMapWidget;

/** @var yii\web\View $this */

$this->title = 'Карта';
$this->params['breadcrumbs'][] = $this->title;

$points = [];
$projects = \app\models\Projects::find()->andWhere(['IS NOT', 'latitude', null])->distinct()->all();
foreach ($projects as $project) {
    $points[] = ['coord' => [$project->longitude, $project->latitude]];
}

$mapWidget = YandexMapWidget::widget(
    [
        'points' => $points
    ]
);

?>
<div class="maps-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php

    echo $mapWidget;

    ?>

</div>