<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskStartedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Task $task) {}

    /**
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $memberName = $this->task->member?->name ?? 'A member';

        return (new MailMessage)
            ->subject('Task Started: '.$this->task->task_title)
            ->greeting('Hello Admin!')
            ->line($memberName.' has started working on a task.')
            ->line('Task: '.$this->task->task_title)
            ->line('Status: In Progress')
            ->action('View Task List', route('tasks.index'));
    }
}
