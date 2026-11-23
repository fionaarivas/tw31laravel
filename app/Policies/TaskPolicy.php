<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * A member may only change the status of a task assigned to their own member account.
     */
    public function updateStatus(User $user, Task $task): bool
    {
        return $user->role === 'member'
            && $user->member !== null
            && $task->member_id === $user->member->id;
    }
}
