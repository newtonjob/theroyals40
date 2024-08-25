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
     * Get the notification's delivery channels.
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
            ->replyTo('adesolaadebisi@gmail.com') // TODO: should be dynamic
            ->subject(config('app.name').": Thank you! 🥂")
            ->greeting(' ')
            ->line("Hi {$notifiable->name},")
            ->line("Thank you for making my 40th birthday celebration so special! Your presence meant the world to me, and I'm truly grateful for your love and support.")
            ->line("Looking forward to many more joyful moments together!")
            ->salutation(new HtmlString('With Love ❤️<br>'. config('app.name')));
    }
}
