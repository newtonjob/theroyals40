<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class InviteFollowup extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("The Royals @ 40: Thank you! 🥂")
            ->greeting(' ')
            ->line("Hello {$notifiable->name}")
            ->line('We want to take this moment to express our sincere gratitude for being a part of our big day. Your presence added all the spice and made the day truly special, and we appreciate the effort you made to join in the festivities.')
            ->line("Thank you once again for being part of this milestone in our lives. It’s a blessing to have wonderful friends and family like you. Looking forward to many more celebrations together!")
            ->salutation(new HtmlString('With Love,<br>'. config('app.name')));
    }
}
