<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class InvitePass extends Notification
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
            ->replyTo('themelagency@gmail.com') // TODO: should be dynamic
            ->subject("Here's your invite to our union 🥂")
            ->greeting(' ')
            ->line("Hello {$notifiable->name}")
            ->line('Thank you again for accepting our invitation.')
            ->line('Attached herein is a formal e-invite that also serves as a pass.')
            ->line('The theme for the day is **boldly elegant**, so dress to impress in your most stylish attire ☺️.')
            ->line('We look forward to partying with you on **Sunday, 26th October 2024** at the **Monarch Event Center, Lagos**.')
            ->line("*PS: This is strictly by invitation and invites admit only **{$notifiable->passes}**. QR cannot be transferred.*")
            ->attach($notifiable);
    }
}
