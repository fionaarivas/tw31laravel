@extends('layouts.member')

@section('title', 'Tasks')

@push('styles')
    <style>
        .tasks {
            display: grid;
            gap: 14px;
        }

        .task {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 18px 24px;
            align-items: start;
        }

        .task-head {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
            margin-bottom: 4px;
        }

        .task-head h3 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .task-meta {
            margin-bottom: 10px;
            color: var(--muted);
            font-size: 13px;
        }

        .task-desc {
            margin: 0;
            color: #e6dde9;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .task-notes {
            margin-top: 14px;
            padding: 10px 14px;
            border-left: 3px solid var(--purple);
            border-radius: 0 10px 10px 0;
            background: var(--surface-2);
            font-size: 14px;
        }

        .task-notes strong {
            display: block;
            margin-bottom: 2px;
            color: var(--muted);
            font-size: 12px;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        .task-action form {
            margin: 0;
        }

        @media (max-width: 720px) {
            .task {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')
    <div class="page-header">
        <h1>My Tasks</h1>
        <p>Tasks assigned to you by the admin. Start a task when you begin working on it, then mark it as completed.</p>
    </div>

    @if ($tasks->isEmpty())
        <div class="card empty">You have no assigned tasks yet.</div>
    @else
        <div class="tasks">
            @foreach ($tasks as $task)
                <article class="card task">
                    <div>
                        <div class="task-head">
                            <h3>{{ $task->task_title }}</h3>
                            @include('member.partials.task-status', ['task' => $task])
                        </div>

                        <div class="task-meta">
                            Assigned {{ $task->created_at?->format('M d, Y') }}
                        </div>

                        <p class="task-desc">{{ $task->description ?: 'No description provided.' }}</p>

                        @if (filled($task->admin_notes))
                            <div class="task-notes">
                                <strong>Admin Notes</strong>
                                {{ $task->admin_notes }}
                            </div>
                        @endif
                    </div>

                    <div class="task-action">
                        @if ($task->isPending())
                            <form method="POST" action="{{ route('member.tasks.start', $task) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-primary">Start Task</button>
                            </form>
                        @elseif ($task->isInProgress())
                            <form method="POST" action="{{ route('member.tasks.complete', $task) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success">Mark as Completed</button>
                            </form>
                        @else
                            <button type="button" class="btn" disabled>Completed</button>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    @endif
@endsection
