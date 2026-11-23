<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskAssignedNotification;
use App\Notifications\TaskStartedNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('member')
            ->latest()
            ->get();

        $members = Member::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('tasks', compact('tasks', 'members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => [
                'required',
                'exists:members,id',
            ],
            'task_title' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
            ],
        ]);

        $member = Member::findOrFail(
            $validated['member_id']
        );

        $task = Task::create([
            'member_id' => $member->id,
            'task_title' => $validated['task_title'],
            'description' => $validated['description'] ?? null,
            'status' => 'pending',
            'completed' => false,
        ]);

        Notification::route(
            'mail',
            $member->email
        )->notify(
            new TaskAssignedNotification($task)
        );

        return redirect()
            ->route('tasks.index')
            ->with(
                'success',
                'Task assigned successfully and email notification sent.'
            );
    }

    public function dashboard()
    {
        abort_unless(
            auth()->user()->role === 'admin',
            403
        );

        $totalTasks = Task::count();

        $pendingTasks = Task::where(
            'status',
            'pending'
        )->count();

        $inProgressTasks = Task::where(
            'status',
            'in_progress'
        )->count();

        $completedTasks = Task::where(
            'status',
            'completed'
        )->count();

        $tasks = Task::with('member')
            ->latest()
            ->get();

        return view(
            'tasks.dashboard',
            compact(
                'totalTasks',
                'pendingTasks',
                'inProgressTasks',
                'completedTasks',
                'tasks'
            )
        );
    }

    public function memberDashboard()
    {
        abort_unless(
            auth()->user()->role === 'member',
            403
        );

        $member = auth()->user()->member;

        abort_unless($member, 403);

        $member->load('membershipTransactions');

        $tasks = $member->tasks()
            ->latest()
            ->get();

        $taskCounts = [
            'pending' => $tasks->where('status', Task::STATUS_PENDING)->count(),
            'in_progress' => $tasks->where('status', Task::STATUS_IN_PROGRESS)->count(),
            'completed' => $tasks->where('status', Task::STATUS_COMPLETED)->count(),
        ];

        $currentMembership = $member->membershipTransactions
            ->where('status', 'approved')
            ->sortByDesc('membership_end_date')
            ->first();

        return view(
            'member.dashboard',
            compact(
                'member',
                'tasks',
                'taskCounts',
                'currentMembership'
            )
        );
    }

    /**
     * List the tasks assigned to the authenticated member.
     */
    public function memberTasks(): View
    {
        abort_unless(
            auth()->user()->role === 'member',
            403
        );

        $member = auth()->user()->member;

        abort_unless($member, 403);

        $tasks = $member->tasks()
            ->latest()
            ->get();

        return view(
            'member.tasks',
            compact('member', 'tasks')
        );
    }

    /**
     * Move a pending task assigned to the member to "in progress" and notify admins.
     */
    public function start(Task $task): RedirectResponse
    {
        Gate::authorize('updateStatus', $task);

        if (! $task->isPending()) {
            throw ValidationException::withMessages([
                'status' => 'Only pending tasks can be started.',
            ]);
        }

        $task->update([
            'status' => Task::STATUS_IN_PROGRESS,
        ]);

        $admins = User::where('role', 'admin')->get();

        if ($admins->isNotEmpty()) {
            Notification::send(
                $admins,
                new TaskStartedNotification($task->load('member'))
            );
        }

        return redirect()
            ->route('member.tasks.index')
            ->with(
                'success',
                'Task started. It is now marked as in progress.'
            );
    }

    /**
     * Mark an in-progress task assigned to the member as completed.
     */
    public function complete(Task $task): RedirectResponse
    {
        Gate::authorize('updateStatus', $task);

        if (! $task->isInProgress()) {
            throw ValidationException::withMessages([
                'status' => 'Only tasks in progress can be marked as completed.',
            ]);
        }

        $task->update([
            'status' => Task::STATUS_COMPLETED,
        ]);

        return redirect()
            ->route('member.tasks.index')
            ->with(
                'success',
                'Task marked as completed.'
            );
    }

    public function destroy(Task $task)
    {
        abort_unless(
            auth()->user()->role === 'admin',
            403
        );

        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with(
                'success',
                'Task removed successfully.'
            );
    }
}