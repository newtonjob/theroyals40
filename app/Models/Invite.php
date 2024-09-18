<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTenant;
use App\Notifications\InvitePass;
use Facades\App\Support\Pdf;
use Illuminate\Contracts\Mail\Attachable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Markdown;
use Illuminate\Notifications\Notifiable;

class Invite extends Model implements Attachable
{
    use HasFactory, Notifiable, BelongsToTenant;

    protected static function booted()
    {
        parent::creating(function (Invite $invite) {
            $invite->remaining = $invite->passes;
        });

        parent::updating(function (Invite $invite) {
            $invite->remaining += ($invite->passes - $invite->getOriginal('passes'));
        });
    }

    public function name(): Attribute
    {
        return Attribute::set(fn ($value) => ($value));
    }

    public function send(): void
    {
        $this->update(['sent_at' => now()]);

        $this->notify(new InvitePass);
    }

    /**
     * Determine if the invite has been sent.
     */
    public function sent()
    {
        return (bool) $this->sent_at;
    }

    /**
     * Get the attachable representation of the model.
     */
    public function toMailAttachment(): Attachment
    {
        return Attachment::fromData(fn () => $this->pdf()->string())
            ->as(str($this->name)->slug()->finish('.pdf'))
            ->withMime('application/pdf');
    }

    public function pdf(): \App\Support\Pdf
    {
        return Pdf::margin(0)->format([215, 200])->name($this->name)->view('invites.show', ['invite' => $this]);
    }

    public function whatsappUrl(): string
    {
        /** @var Markdown $markdown */
        $markdown = app(Markdown::class);

        $notification = (new InvitePass)->toMail($this);

        //$text = $markdown->renderText($notification->markdown, $notification->data());

        $text = collect($notification->introLines)
            ->add(url()->signedRoute('invites.show', $this))
            ->implode("\n\n");

        $text = str($text)->replace('*', '_')->replace('__', '*');

        return 'https://api.whatsapp.com/send?text='.urlencode($text);
    }
}
