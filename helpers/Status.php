<?php

namespace app\helpers;

class Status
{
    const MODERATOR_PROJECT_STATUS = [
        'new', 'in_progress', 'completed', 'failed', 'back_to_work'
    ];

    const CITIZEN_PROJECT_STATUS = [
        'confirmed', 'failed'
    ];
}