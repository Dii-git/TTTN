<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotifyInactiveUser extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('You are not using our website for 1 day')
            ->action('Please login again', route('login'))
            ->line('Thank you for joining our codechief community!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}