@extends('layouts.member')

@section('title', 'My Tasks')

@push('styles')
    <style>
        .task-grid {
            display: grid;
            gap: 14px;
        }

        .task-card {
            padding: 22px 24px;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            background: var(--card);
            box-shadow: var(--shadow);
        }

        .task-card h2 {
            margin: 0 0 6px;
            font-size: 16px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .task-description {
            margin: 0 0 10px;
            color: var(--muted);
            overflow-wrap: anywhere;
        }

        .task-date {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--muted);
            font-size: 13px;
        }

        .task-date .icon {
            width: 15px;
            height: 15px;
        }

        .task-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 18px;
            padding-top: 16px;
            border-top: 1px solid var(--border);
        }

        .task-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 12.5px;
            font-weight: 700;
            white-space: nowrap;
        }

        .task-status::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .status-pending {
            background: var(--amber-bg);
            color: var(--amber);
        }

        .status-in_progress,
        .status-in-progress {
            background: var(--violet-bg);
            color: var(--violet);
        }

        .status-completed {
            background: var(--green-bg);
            color: var(--green);
        }

        .task-actions form {
            margin: 0;
        }

        .task-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-width: 170px;
            height: 40px;
            padding: 0 18px;
            border: 1px solid transparent;
            border-radius: 10px;
            background: var(--pink);
            color: var(--on-pink);
            cursor: pointer;
            font: inherit;
            font-size: 14px;
            font-weight: 700;
            transition: background .15s, color .15s;
        }

        .task-button:hover {
            background: var(--pink-hover);
        }

        .task-button.is-secondary {
            background: transparent;
            border-color: var(--pink);
            color: var(--pink);
        }

        .task-button.is-secondary:hover {
            background: var(--pink-soft);
        }

        .task-button[disabled] {
            background: var(--grey-bg);
            border-color: transparent;
            color: var(--muted);
            cursor: not-allowed;
        }

        .task-button:focus-visible {
            outline: 2px solid var(--pink);
            outline-offset: 2px;
        }

        .task-grid + .empty,
        .page-header + .empty {
            border: 1px dashed var(--border-strong);
            border-radius: var(--radius);
        }

        @media (max-width: 600px) {
            .task-actions {
                align-items: stretch;
                flex-direction: column;
            }

            .task-status {
                align-self: flex-start;
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
                        <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                            <rect x="4" y="5" width="16" height="15" rx="2.5" />
                            <path d="M4 10h16M9 3v4M15 3v4" />
                        </svg>
                        Assigned
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
                                    class="task-button is-secondary"
                                >
                                    Mark as Completed
                                </button>
                            </form>
                        @else
                            <button
                                type="button"
                                class="task-button"
                                disabled
                            >
                                Completed
                            </button>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    @endif
@endsection