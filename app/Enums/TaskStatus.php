<?php

namespace App\Enums;

use Spatie\Enum\Enum;

class TaskStatus extends Enum
{
    public static function notStarted(): TaskStatus
    {
        return new class () extends TaskStatus {
            public function getValue(): string
            {
                return 'not_started';
            }
        };
    }

    public static function inProgress(): TaskStatus
    {
        return new class () extends TaskStatus {
            public function getValue(): string
            {
                return 'in_progress';
            }
        };
    }

    public static function completed(): TaskStatus
    {
        return new class () extends TaskStatus {
            public function getValue(): string
            {
                return 'completed';
            }
        };
    }
}
