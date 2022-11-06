<?php

namespace app\commands;

use app\models\Users;
use yii\console\Controller;
use yii\console\ExitCode;

class UsersController extends Controller
{
    /**
     * @return int
     */
    public function actionCreate(): int
    {
        $user = new Users();
        $user->load([
            'login' => 'ADMIN',
            'password' => '123456',
            'role' => 'admin'
        ], '');
        $user->save();

        return ExitCode::OK;
    }
}