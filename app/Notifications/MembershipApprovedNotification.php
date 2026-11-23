<?php

namespace App\Notifications;

use App\Models\MembershipTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MembershipApprovedNotification
    extends Notification
    implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public MembershipTransaction $transaction
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
        $this->transaction->loadMissing([
            'member',
            'membershipLevel',
        ]);

        $member = $this->transaction->member;
        $level = $this->transaction->membershipLevel;

        return (new MailMessage)
            ->subject('Membership Account Activated')
            ->greeting('Hello ' . $member->name . '!')
            ->line(
                'Your membership application has been approved.'
            )
            ->line(
                'Your member account is now active.'
            )
            ->line(
                'Membership Level: ' . $level->name
            )
            ->line(
                'Transaction Number: ' .
                $this->transaction->transaction_number
            )
            ->line(
                'Membership Start Date: ' .
                $this->transaction
                    ->membership_start_date
                    ->format('F d, Y')
            )
            ->line(
                'Membership End Date: ' .
                $this->transaction
                    ->membership_end_date
                    ->format('F d, Y')
            )
            ->action(
                'Open Membership Dashboard',
                route('member.dashboard')
            )
            ->line(
                'Thank you for registering with us!'
            );
    }

    public function toArray(object $notifiable): array
    {
        return [
            'transaction_id' =>
                $this->transaction->id,

            'transaction_number' =>
                $this->transaction->transaction_number,

            'message' =>
                'Your membership account is now active.',
        ];
    }
}