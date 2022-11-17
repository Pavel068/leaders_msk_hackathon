<?php

namespace app\controllers;

use app\controllers\_AdminController;
use yii\filters\VerbFilter;

class MapsController extends _AdminController
{
    /**
     * @return string
     */
    public function actionIndex(): string
    {
        return $this->render('index', []);
    }
}