<?php

namespace app\helpers;

class Status
{
    const MODERATOR_PROJECT_STATUS = [
        'new' => 'Новый',
        'in_progress' => 'Выполняется',
        'completed' => 'Завершено',
        'failed' => 'Не завершено',
        'back_to_work' => 'Возвращен в работу'
    ];

    const CITIZEN_PROJECT_STATUS = [
        'new' => 'Не проверен',
        'confirmed' => 'Подтвержден',
        'failed' => 'Не подтвержден'
    ];
}