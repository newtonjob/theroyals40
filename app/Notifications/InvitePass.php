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
            ->subject("Here's your invite to our celebration 🥂")
            ->replyTo('pamelaogujiuba@gmail.com')
            ->greeting(' ')
            ->line("Hello {$notifiable->name}")
            ->line('Thank you again for accepting our invitation.')
            ->line('Attached herein is a formal e-invite that also serves as a pass.')
            ->line('The theme for the evening is **boldly elegant**, so dress to impress in your most stylish attire ☺️.')
            ->when(
                $notifiable->category !== 'After Party',
                fn ($message) => $message
                    ->line('Please find details below;')
                    ->line('- Cocktail: 5pm')
                    ->line('- Fine Dining: 7pm')
                    ->line('- After party: 9pm')
                    ->line('We look forward to partying with you on the **5th of January, 2024** at the **Monarch Event Centre Lagos**.'),
                fn ($message) => $message
                    ->line('We look forward to partying with you on the **5th of January, 2024 - 9pm** at the **Monarch Event Center, Lagos**.'),
            )
            ->action('Download your invite', URL::signedRoute('invites.show', $notifiable))
            ->line("*Important: This invite admits **{$notifiable->passes}**.*");
    }
}
