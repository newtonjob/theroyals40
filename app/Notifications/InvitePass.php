<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SimpleMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

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
            ->greeting("Dear {$notifiable->name}")
            ->line('Thank you again for accepting our invitation.')
            ->line('Attached herein is a formal e-invite that also serves as a pass.')
            ->line('- Venue: Monarch Event Centre, Lagos')
            ->line('- Date: 26th October, 2024')
            ->line('- Time: **3 PM**')
            ->line('- Dress Code/Theme: Black tie / boldly elegant, so dress to impress in your most stylish attire.')
            ->line('We look forward to celebrating with you.')
            ->line("*This invite admits **only {$notifiable->passes}**. QR cannot be transferred.*")
            ->salutation(new HtmlString("Regards,<br>".config('app.name')))
            ->attach($notifiable);
    }

    /**
     * Get the whatsapp representation of the notification.
     */
    public function toWhatsapp(object $notifiable): SimpleMessage
    {
        return (new SimpleMessage)
            ->line("Dear {$notifiable->name}")
            ->line('Thank you again for accepting our invitation.')
            ->line('Attached herein is a formal e-invite that also serves as a pass.')
            ->line('- Venue: Monarch Event Centre, Lagos')
            ->line('- Date: 26th October, 2024')
            ->line('- Time: *3 PM*')
            ->line('- Dress Code/Theme: Black tie / boldly elegant, so dress to impress in your most stylish attire.')
            ->line('We look forward to celebrating with you.')
            ->line("_This invite admits *only {$notifiable->passes}*. QR cannot be transferred._")
            ->line(new HtmlString("Regards,\n".config('app.name')))
            ->line(url()->signedRoute('invites.show', $notifiable));
    }

    public function shouldSend(): bool
    {
        return tenant()->domain === 'therawaunion.plaininvite.com';
    }
}
