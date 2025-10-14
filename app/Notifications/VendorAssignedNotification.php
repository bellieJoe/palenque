<?php

namespace App\Notifications;

use App\Models\Stall;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VendorAssignedNotification extends Notification
{
    use Queueable;
    public $stall;
    /**
     * Create a new notification instance.
     */
    public function __construct(Stall $stall)
    {
        //
        $this->stall = $stall;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Good Day ' . $notifiable->name . '.')
            ->line('You have been successfully assigned to stall '.$this->stall->name)
            ->line('Thank you for using '.config('app.name').'!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Stall Assignment',
            'message' => 'You have been successfully assigned to stall '.$this->stall->name,
            'url' => ''
        ];
    }
}
