<?php

namespace app\commands;

use app\models\Devices;
use app\models\Items;
use app\models\Types;
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
        $data = json_decode(file_get_contents(__DIR__ . '/data/items.json'), true);



        return ExitCode::OK;
    }
}