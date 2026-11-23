<?php

use App\Models\Member;
use App\Models\MembershipTransaction;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskStartedNotification;
use Illuminate\Support\Facades\Notification;

beforeEach(function () {
    $this->member = Member::factory()->create();
    $this->memberUser = $this->member->user;
});

test('member dashboard shows membership details and task counts', function () {
    Task::factory()->for($this->member)->create();
    Task::factory()->for($this->member)->inProgress()->create();
    Task::factory()->for($this->member)->completed()->count(2)->create();

    MembershipTransaction::create([
        'transaction_number' => 'TRX-TEST-1',
        'member_id' => $this->member->id,
        'membership_level_id' => $this->member->membership_level_id,
        'transaction_type' => 'application',
        'amount' => 500,
        'status' => 'approved',
        'transaction_date' => '2026-01-01',
        'membership_start_date' => '2026-01-05',
        'membership_end_date' => '2027-01-05',
    ]);

    $this->actingAs($this->memberUser)
        ->get(route('member.dashboard'))
        ->assertOk()
        ->assertSee($this->member->name)
        ->assertSee($this->member->membership_number)
        ->assertSee('Jan 05, 2026')
        ->assertSee('Jan 05, 2027')
        ->assertViewHas('taskCounts', [
            'pending' => 1,
            'in_progress' => 1,
            'completed' => 2,
        ])
        ->assertDontSee($this->member->membershipCategory->name)
        ->assertDontSee($this->member->membershipLevel->name)
        ->assertDontSee('/about');
});

test('member tasks page only lists the members own tasks with the right actions', function () {
    $pending = Task::factory()->for($this->member)->create();
    $inProgress = Task::factory()->for($this->member)->inProgress()->create();
    Task::factory()->for($this->member)->completed()->create();
    $otherTask = Task::factory()->create();

    $this->actingAs($this->memberUser)
        ->get(route('member.tasks.index'))
        ->assertOk()
        ->assertSee($pending->task_title)
        ->assertSee(route('member.tasks.start', $pending))
        ->assertSee(route('member.tasks.complete', $inProgress))
        ->assertSee('Start Task')
        ->assertSee('Mark as Completed')
        ->assertSee('Completed')
        ->assertDontSee($otherTask->task_title);
});

test('member can start a pending task and admins are notified', function () {
    Notification::fake();

    $admin = User::factory()->create(['role' => 'admin']);
    $task = Task::factory()->for($this->member)->create();

    $this->actingAs($this->memberUser)
        ->patch(route('member.tasks.start', $task))
        ->assertRedirect(route('member.tasks.index'));

    expect($task->fresh())
        ->status->toBe(Task::STATUS_IN_PROGRESS)
        ->completed->toBeFalse();

    Notification::assertSentTo($admin, TaskStartedNotification::class);
});

test('member can complete an in progress task', function () {
    $task = Task::factory()->for($this->member)->inProgress()->create();

    $this->actingAs($this->memberUser)
        ->patch(route('member.tasks.complete', $task))
        ->assertRedirect(route('member.tasks.index'));

    expect($task->fresh())
        ->status->toBe(Task::STATUS_COMPLETED)
        ->completed->toBeTrue();
});

test('invalid status transitions are rejected', function () {
    $pending = Task::factory()->for($this->member)->create();
    $completed = Task::factory()->for($this->member)->completed()->create();

    $this->actingAs($this->memberUser)
        ->patch(route('member.tasks.complete', $pending))
        ->assertSessionHasErrors('status');

    $this->actingAs($this->memberUser)
        ->patch(route('member.tasks.start', $completed))
        ->assertSessionHasErrors('status');

    expect($pending->fresh()->status)->toBe(Task::STATUS_PENDING);
    expect($completed->fresh()->status)->toBe(Task::STATUS_COMPLETED);
});

test('member cannot update another members task', function () {
    $otherTask = Task::factory()->create();
    $otherInProgress = Task::factory()->inProgress()->create();

    $this->actingAs($this->memberUser)
        ->patch(route('member.tasks.start', $otherTask))
        ->assertForbidden();

    $this->actingAs($this->memberUser)
        ->patch(route('member.tasks.complete', $otherInProgress))
        ->assertForbidden();

    expect($otherTask->fresh()->status)->toBe(Task::STATUS_PENDING);
    expect($otherInProgress->fresh()->status)->toBe(Task::STATUS_IN_PROGRESS);
});

test('admin cannot use member task status routes', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $task = Task::factory()->for($this->member)->create();

    $this->actingAs($admin)
        ->patch(route('member.tasks.start', $task))
        ->assertForbidden();
});

test('my membership page is read only and hides category and level', function () {
    MembershipTransaction::create([
        'transaction_number' => 'TRX-TEST-2',
        'member_id' => $this->member->id,
        'membership_level_id' => $this->member->membership_level_id,
        'transaction_type' => 'application',
        'amount' => 750,
        'status' => 'pending',
        'transaction_date' => '2026-02-01',
    ]);

    $this->actingAs($this->memberUser)
        ->get(route('member.transactions'))
        ->assertOk()
        ->assertSee($this->member->email)
        ->assertSee($this->member->phone_number)
        ->assertSee('TRX-TEST-2')
        ->assertSee('Unpaid')
        ->assertDontSee($this->member->membershipCategory->name)
        ->assertDontSee($this->member->membershipLevel->name)
        ->assertDontSee(route('members.edit', $this->member))
        ->assertDontSee('Deactivate');
});

test('member navigation links to every member page and marks the current one', function () {
    $this->actingAs($this->memberUser)
        ->get(route('member.transactions'))
        ->assertOk()
        ->assertSee(route('member.dashboard'))
        ->assertSee(route('member.tasks.index'))
        ->assertSee(route('member.transactions'))
        ->assertSee('class="active"', false);
});

test('admin task list shows in progress status', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    Task::factory()->for($this->member)->inProgress()->create();

    $this->actingAs($admin)
        ->get(route('tasks.index'))
        ->assertOk()
        ->assertSee('In Progress');

    $this->actingAs($admin)
        ->get(route('task.dashboard'))
        ->assertOk()
        ->assertSee('In Progress');
});

test('legacy completed flag keeps status in sync', function () {
    $task = Task::factory()->for($this->member)->create();

    $task->update(['completed' => true]);

    expect($task->fresh()->status)->toBe(Task::STATUS_COMPLETED);
});
