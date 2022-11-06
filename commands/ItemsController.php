<?php

namespace app\commands;

use app\helpers\Helper;
use app\helpers\Status;
use app\models\Projects;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\rbac\Item;

class ItemsController extends Controller
{
    /**
     * @return int
     */
    public function actionMassCreate(): int
    {
        Helper::writeData();

        return ExitCode::OK;
    }
}