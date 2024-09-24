<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

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
            ->replyTo('themelagency@gmail.com') // TODO: should be dynamic from tenant
            ->subject("Here's your invite to our union 🥂")
            ->greeting(' ')
            ->line("Dear {$notifiable->name}")
            ->line('Thank you again for accepting our invitation.')
            ->line('Attached herein is a formal e-invite that also serves as a pass.')
            ->line('- Venue: Monarch Event Centre, Lagos')
            ->line('- Date: 26th October, 2024')
            ->line('- Time: 3 PM')
            ->line('- Dress Code/Theme: Black tie / boldly elegant, so dress to impress in your most stylish attire.')
            ->line('We look forward to celebrating with you.')
            ->line("*This invite admits **only {$notifiable->passes}**. QR cannot be transferred.*")
            ->attach($notifiable);
    }

    public function shouldSend(): bool
    {
        return tenant()->domain === 'therawaunion.plaininvite.com';
    }
}
