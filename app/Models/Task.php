<?php

namespace App\Models;

use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'deadline',
    ];

    public const TASK_STATUSES = [
        TaskStatus::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $value
     * @return TaskStatus
     */
    public function getStatusAttribute($value): TaskStatus
    {
        return new TaskStatus($value);
    }

    /**
     * @param $status
     * @return void
     */
    public function setStatusAttribute($status): void
    {
        $this->attributes['status'] = $status;
    }
}

