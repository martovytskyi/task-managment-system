<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self NOT_STARTED()
 * @method static self IN_PROGRESS()
 * @method static self COMPLETED()
 */
class TaskStatus extends Enum
{
    public static function toSelectArray(): array
    {
        return [
            'NOT_STARTED' => 'not_started',
            'IN_PROGRESS' => 'in_progress',
            'COMPLETED' => 'completed',
        ];
    }
}
