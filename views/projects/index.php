<?php

use app\helpers\Status;
use app\models\Projects;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ProjectsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Проекты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projects-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'description:ntext',
            'price',
            'location_text',
            [
                'attribute' => 'moderator_status',
                'value' => function ($model) {
                    return $model['moderator_status'] ? Status::MODERATOR_PROJECT_STATUS[$model['moderator_status']] : null;
                },
                'filter' => Status::MODERATOR_PROJECT_STATUS
            ],
            [
                'attribute' => 'citizen_status',
                'value' => function ($model) {
                    return $model['citizen_status'] ? Status::CITIZEN_PROJECT_STATUS[$model['citizen_status']] : null;
                },
                'filter' => Status::CITIZEN_PROJECT_STATUS
            ],
            [
                'class' => ActionColumn::className(),
                'template' => Yii::$app->getUser()->identity && Yii::$app->getUser()->identity->role === 'admin' ? '{view}{delete}{update}' : '{view}{update}',
                'urlCreator' => function ($action, Projects $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
