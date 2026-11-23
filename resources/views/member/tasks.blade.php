@extends('layouts.member')

@section('title', 'My Tasks')

@push('styles')
    <style>
        .task-grid {
            display: grid;
            gap: 18px;
        }

        .task-card {
            padding: 22px;
            border: 1px solid var(--border);
            border-radius: 16px;
            background: var(--card);
        }

        .task-card h2 {
            margin: 0 0 8px;
            font-size: 19px;
        }

        .task-description {
            margin: 0 0 14px;
            color: var(--muted);
            line-height: 1.6;
        }

        .task-date {
            margin-bottom: 16px;
            color: var(--muted);
            font-size: 13px;
        }

        .task-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 18px;
        }

        .task-status {
            display: inline-flex;
            padding: 6px 11px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
        }

        .status-pending {
            background: rgba(240, 173, 85, .15);
            color: var(--amber);
        }

        .status-in-progress {
            background: rgba(180, 138, 255, .15);
            color: var(--violet);
        }

        .status-completed {
            background: rgba(99, 217, 155, .15);
            color: var(--green);
        }

        .task-button {
            padding: 9px 15px;
            border: 0;
            border-radius: 8px;
            background: var(--pink);
            color: #211923;
            cursor: pointer;
            font-size: 12px;
            font-weight: 700;
        }

        .task-button:hover {
            opacity: .88;
        }

        .empty {
            padding: 35px;
            border: 1px dashed var(--border);
            border-radius: 16px;
            color: var(--muted);
            text-align: center;
        }

        @media (max-width: 600px) {
            .task-actions {
                align-items: flex-start;
                flex-direction: column;
            }

            .task-button {
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')
    <div class="page-header">
        <h1>My Tasks</h1>

        <p>
            View and update the tasks assigned to you.
        </p>
    </div>

    @if (session('success'))
        <div class="notice">
            {{ session('success') }}
        </div>
    @endif

    @if ($tasks->isEmpty())
        <div class="empty">
            You have no assigned tasks yet.
        </div>
    @else
        <div class="task-grid">
            @foreach ($tasks as $task)
                @php
                    $status = $task->status
                        ?? ($task->completed
                            ? 'completed'
                            : 'pending');
                @endphp

                <article class="task-card">
                    <h2>
                        {{ $task->task_title }}
                    </h2>

                    <p class="task-description">
                        {{ $task->description ?: 'No description provided.' }}
                    </p>

                    <div class="task-date">
                        Assigned:
                        {{ $task->created_at?->format('M d, Y') ?? '—' }}
                    </div>

                    <div class="task-actions">
                        <span
                            class="task-status status-{{ $status }}"
                        >
                            {{ ucwords(str_replace('_', ' ', $status)) }}
                        </span>

                        @if ($status === 'pending')
                            <form
                                method="POST"
                                action="{{ route('member.tasks.start', $task) }}"
                            >
                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="task-button"
                                >
                                    Start Task
                                </button>
                            </form>
                        @elseif ($status === 'in_progress')
                            <form
                                method="POST"
                                action="{{ route('member.tasks.complete', $task) }}"
                            >
                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="task-button"
                                >
                                    Mark as Completed
                                </button>
                            </form>
                        @else
                            <span class="task-status status-completed">
                                Completed
                            </span>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    @endif
@endsection