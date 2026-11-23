@extends('layouts.member')

@section('title', 'Dashboard')

@push('styles')
    <style>
        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            padding: 0;
            overflow: hidden;
        }

        .stat {
            padding: 20px 24px;
        }

        .stat + .stat {
            border-left: 1px solid var(--border);
        }

        .stat-label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--muted);
            font-size: 13px;
            font-weight: 500;
        }

        .stat-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .stat-value {
            margin-top: 6px;
            font-size: 28px;
            font-weight: 700;
            line-height: 1.1;
        }

        .task-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .task-list li {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 14px 0;
        }

        .task-list li + li {
            border-top: 1px solid var(--border);
        }

        .task-list .title {
            font-weight: 500;
            overflow-wrap: anywhere;
        }

        .task-list .date {
            color: var(--muted);
            font-size: 13px;
        }

        .notice {
            margin-top: 16px;
            padding: 12px 16px;
            border-radius: 12px;
            background: var(--amber-bg);
            color: var(--amber);
            font-size: 14px;
        }

        @media (max-width: 720px) {
            .stats {
                grid-template-columns: 1fr;
            }

            .stat + .stat {
                border-left: 0;
                border-top: 1px solid var(--border);
            }

            .stat {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 14px 18px;
            }

            .stat-value {
                margin: 0;
                font-size: 22px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="page-header">
        <h1>Welcome back, {{ $member->name }}</h1>
        <p>Here is an overview of your membership and tasks.</p>
    </div>

    <section class="section" style="margin-top: 0;">
        <div class="section-head">
            <h2>Membership</h2>
            <a href="{{ route('member.membership') }}">View details</a>
        </div>

        <div class="card">
            <dl class="details">
                <div>
                    <dt>Member Name</dt>
                    <dd>{{ $member->name }}</dd>
                </div>

                <div>
                    <dt>Membership No.</dt>
                    <dd>{{ $member->membership_number }}</dd>
                </div>

                <div>
                    <dt>Status</dt>
                    <dd>@include('member.partials.membership-status', ['status' => $member->status])</dd>
                </div>

                <div>
                    <dt>Start Date</dt>
                    <dd>{{ $currentMembership?->membership_start_date?->format('M d, Y') ?? '—' }}</dd>
                </div>

                <div>
                    <dt>End Date</dt>
                    <dd>{{ $currentMembership?->membership_end_date?->format('M d, Y') ?? '—' }}</dd>
                </div>
            </dl>

            @if (strtolower($member->status ?? '') === 'pending')
                <div class="notice">
                    Your membership application is awaiting admin approval. Start and end dates will appear once it is approved.
                </div>
            @endif
        </div>
    </section>

    <section class="section">
        <div class="section-head">
            <h2>Task Summary</h2>
            <a href="{{ route('member.tasks.index') }}">View all tasks</a>
        </div>

        <div class="card stats">
            <div class="stat">
                <div class="stat-label">
                    <span class="stat-dot" style="background: var(--amber);"></span>
                    Pending
                </div>
                <div class="stat-value">{{ $taskCounts['pending'] }}</div>
            </div>

            <div class="stat">
                <div class="stat-label">
                    <span class="stat-dot" style="background: var(--violet);"></span>
                    In Progress
                </div>
                <div class="stat-value">{{ $taskCounts['in_progress'] }}</div>
            </div>

            <div class="stat">
                <div class="stat-label">
                    <span class="stat-dot" style="background: var(--green);"></span>
                    Completed
                </div>
                <div class="stat-value">{{ $taskCounts['completed'] }}</div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="section-head">
            <h2>Recent Tasks</h2>
        </div>

        <div class="card">
            @if ($tasks->isEmpty())
                <div class="empty">You have no assigned tasks yet.</div>
            @else
                <ul class="task-list">
                    @foreach ($tasks->take(5) as $task)
                        <li>
                            <div>
                                <div class="title">{{ $task->task_title }}</div>
                                <div class="date">Assigned {{ $task->created_at?->format('M d, Y') }}</div>
                            </div>

                            @include('member.partials.task-status', ['task' => $task])
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </section>
@endsection
