<?php

namespace App\Models;

use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public const NOT_STARTED = 'not_started';
    public const IN_PROGRESS = 'in_progress';
    public const COMPLETED = 'completed';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'deadline',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public const TASK_STATUSES = [
        self::NOT_STARTED,
        self::IN_PROGRESS,
        self::COMPLETED
    ];
}

