<?php

/** @var yii\web\View $this */

/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => '@web/favicon.ico']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);

    $adminItems = [
        ['label' => 'Проекты', 'url' => ['/projects/index']],
        ['label' => 'Карта', 'url' => ['/maps/index']],
        ['label' => 'Пользователи', 'url' => ['/users/index']],
        ['label' => 'Файлы', 'url' => ['/files/index']],
        ['label' => 'Настройки', 'url' => ['/settings/index']]
    ];

    $citizenItems = [
        ['label' => 'Проекты', 'url' => ['/projects/index']],
    ];

    $items = [];
    if (Yii::$app->user->isGuest) {
        $items[] = ['label' => 'Авторизация', 'url' => ['/site/login']];
    } else {
        if (Yii::$app->user->identity->role === 'admin') {
            $items = [
                ['label' => 'Проекты', 'url' => ['/projects/index']],
                ['label' => 'Карта', 'url' => ['/maps/index']],
                ['label' => 'Пользователи', 'url' => ['/users/index']],
                ['label' => 'Файлы', 'url' => ['/files/index']],
                ['label' => 'Обученные Модели', 'url' => ['/trained-models/index']],
                ['label' => 'Настройки', 'url' => ['/settings/index']],
                ['label' => 'Очередь', 'url' => ['/queue/index']],
                (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                    . Html::submitButton(
                        'Выйти',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ];
        } else if (Yii::$app->user->identity->role === 'citizen') {
            $items = [
                ['label' => 'Проекты', 'url' => ['/projects/index']],
                (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                    . Html::submitButton(
                        'Выйти',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ];
        }
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $items
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
