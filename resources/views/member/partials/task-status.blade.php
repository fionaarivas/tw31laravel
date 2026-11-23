@php
    $taskBadge = match ($task->status) {
        \App\Models\Task::STATUS_COMPLETED => 'badge-success',
        \App\Models\Task::STATUS_IN_PROGRESS => 'badge-info',
        default => 'badge-warning',
    };
@endphp

<span class="badge {{ $taskBadge }}">{{ $task->statusLabel() }}</span>
