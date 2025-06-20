<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SimpleMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Number;

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

            ->linesIf($notifiable->category !== 'After Party', [
                'Thank you again for accepting our wedding invitation.',
                "Attached is your formal e-invite and pass."
            ])
            ->linesIf($notifiable->category == 'After Party', [
                'Kasha and Jibola cordially invite you to their wedding ceremony.'
            ])

            ->line('- Venue: Monarch Event Centre, Lagos')
            ->line('- Date: 26th October, 2024')
            ->line('- Time: **3 PM**')

            ->linesIf($notifiable->category !== 'After Party', [
                "- Dress Code/Theme: Black tie / boldly elegant, so dress to impress in your most stylish attire.",
                "We look forward to celebrating with you.",
                "*This invite admits **only {$notifiable->passes}**. QR cannot be transferred.*"
            ])

            ->linesIf($notifiable->category == 'After Party', [
                '**Card admits '.Number::spell($notifiable->passes).'**'
            ])

            ->salutation(new HtmlString("Regards,<br>".config('app.name')))
            ->attach($notifiable);
    }

    /**
     * Get the whatsapp representation of the notification.
     */
    public function toWhatsapp(object $notifiable): SimpleMessage
    {
        $party = $notifiable->category == 'After Party';

        return (new SimpleMessage)
            ->line("Dear {$notifiable->name}")
            ->linesIf(! $party, [
                'Thank you again for accepting our wedding invitation. Attached is your formal e-invite and pass.',
            ])
            ->linesIf($party, [
                'Kasha and Jibola cordially invite you to their wedding ceremony.'
            ])

            ->lineIf($party, new HtmlString("- Venue: Monarch Event Centre, Lagos\n- Date: 26th October, 2024\n- Time: *8:00 PM*"))
            ->lineIf(! $party, new HtmlString("- Venue: Monarch Event Centre, Lagos\n- Date: 26th October, 2024\n- Time: *3:00 PM*"))

            ->linesIf(! $party, [
                "Dress Code/Theme: Black tie and boldly elegant, so dress to impress in your most stylish attire.",
                "We look forward to celebrating with you.",
                "_This invite admits *only {$notifiable->passes}*. QR cannot be transferred._"
            ])

            ->linesIf($party, [
                '*Card admits '.Number::spell($notifiable->passes).'*'
            ])

            ->line(new HtmlString("Regards,\n".config('app.name')))
            ->line(url()->signedRoute('invites.show', $notifiable));
    }

    public function shouldSend(): bool
    {
        return tenant()->domain === 'therawaunion.plaininvite.com';
    }
}
