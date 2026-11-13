<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskAssignedNotification
    extends Notification
    implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Task $task
    ) {
    }

    public function via(object $notifiable): array
    {
        return [
            'mail',
        ];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Task Assigned')

            ->greeting(
                'Hello!'
            )

            ->line(
                'A new task has been assigned to you.'
            )

            ->line(
                'Task: ' . $this->task->task_title
            )

            ->line(
                'Description: ' .
                (
                    $this->task->description
                    ?: 'No description provided.'
                )
            )

            ->action(
                'View My Tasks',
                url('/member/dashboard')
            )

            ->line(
                'Please log in to view your assigned task.'
            );
    }
}