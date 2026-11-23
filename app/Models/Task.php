<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'pending';

    public const STATUS_IN_PROGRESS = 'in_progress';

    public const STATUS_COMPLETED = 'completed';

    /**
     * @var array<string, string>
     */
    public const STATUS_LABELS = [
        self::STATUS_PENDING => 'Pending',
        self::STATUS_IN_PROGRESS => 'In Progress',
        self::STATUS_COMPLETED => 'Completed',
    ];

    protected $fillable = [
        'member_id',
        'task_title',
        'description',
        'status',
        'admin_notes',
        'completed',
    ];

    protected $attributes = [
        'status' => self::STATUS_PENDING,
        'completed' => false,
    ];

    protected $casts = [
        'completed' => 'boolean',
    ];

    /**
     * Keep the legacy `completed` flag in sync with the workflow status.
     */
    protected static function booted(): void
    {
        static::saving(function (Task $task): void {
            if ($task->isDirty('status')) {
                $task->completed = $task->status === self::STATUS_COMPLETED;
            } elseif ($task->isDirty('completed')) {
                $task->status = $task->completed
                    ? self::STATUS_COMPLETED
                    : self::STATUS_PENDING;
            }
        });
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isInProgress(): bool
    {
        return $this->status === self::STATUS_IN_PROGRESS;
    }

    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    public function statusLabel(): string
    {
        return self::STATUS_LABELS[$this->status] ?? ucfirst((string) $this->status);
    }
}
