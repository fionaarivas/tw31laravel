<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Task;
use App\Notifications\TaskAssignedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('member')
            ->latest()
            ->get();

        $members = Member::where(
            'status',
            'active'
        )
            ->orderBy('name')
            ->get();

        return view(
            'tasks',
            compact(
                'tasks',
                'members'
            )
        );
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
            'completed',
            false
        )->count();

        $completedTasks = Task::where(
            'completed',
            true
        )->count();

        $tasks = Task::with('member')
            ->latest()
            ->get();

        return view(
            'tasks.dashboard',
            compact(
                'totalTasks',
                'pendingTasks',
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

        $tasks = $member->tasks()
            ->latest()
            ->get();

        return view(
            'member.dashboard',
            compact(
                'member',
                'tasks'
            )
        );
    }

    public function complete(Task $task)
    {
        abort_unless(
            auth()->user()->role === 'member',
            403
        );

        $member = auth()->user()->member;

        abort_unless($member, 403);

        abort_unless(
            $task->member_id === $member->id,
            403
        );

        $task->update([
            'completed' => true,
        ]);

        return redirect()
            ->route('member.dashboard')
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