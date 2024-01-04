<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class InviteReminder extends Notification implements ShouldQueue
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
            ->subject("The Royals @ 40: It's Tomorrow! 🥂")
            ->greeting(' ')
            ->line("Hello {$notifiable->name}")
            ->line('Just a quick heads up - The much anticipated celebration is happening tomorrow, the **5th of January** and we can’t wait to have you join the festivities.')
            ->line("Venue: Monarch Event Centre")
            ->when(
                $notifiable->category !== 'After Party',
                fn ($message) => $message
                    ->line('- Cocktail: 5pm')
                    ->line('- Fine Dining: 7pm')
                    ->line('- After party: 9pm'),
                fn ($message) => $message->line('Time: 9pm'),
            )
            ->line('We have put together a night filled with fun, good company and good food. It wouldn’t be the same without you so make sure you come ready to celebrate this milestone with us.')
            ->line('If you need any additional details, feel free to hit us up.')
            ->line('Oops! Lest I forget, come looking boldly elegant ☺️.')
            ->line('Just in case you missed it, here is your invite again.')
            ->action('Download your invite', URL::signedRoute('invites.show', $notifiable))
            ->line("*This invite admits **{$notifiable->passes}**.*");
    }
}
