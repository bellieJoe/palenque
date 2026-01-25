<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MonthlyRentNotification extends Notification
{
    use Queueable;

    private $monthlyRent;

    /**
     * Create a new notification instance.
     */
    public function __construct($monthlyRent)
    {
        $this->monthlyRent = $monthlyRent;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', "database"];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Good day ' . $notifiable->name . ',')
            ->line(
                'This is a reminder that you have an unpaid monthly rent of ₱' .
                number_format($this->monthlyRent->amount, 2) .
                ' for stall ' .
                $this->monthlyRent->stallContract->stall->name .
                ' for the month of ' .
                \Carbon\Carbon::parse($this->monthlyRent->due_date)->format('F Y') .
                '.'
            )
            ->line('Please settle your payment before the due date to avoid penalties.')
            // ->action('View Details', url('/monthly-rents')) // optional button
            ->salutation('Thank you.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
         return [
            //
            "message" => "You have unpaid monthly rent for stall " . $this->monthlyRent->stallContract->stall->name . " for the month of " . \Carbon\Carbon::parse($this->monthlyRent->due_date)->format('F Y') . ".",
            "type" => "danger",
            "title" => "Due Payment"
        ];
    }
}
