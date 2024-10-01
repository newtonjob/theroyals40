<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTenant;
use App\Notifications\InvitePass;
use Illuminate\Contracts\Mail\Attachable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Attachment;
use Illuminate\Notifications\Notifiable;

class Invite extends Model implements Attachable
{
    use HasFactory, Notifiable, BelongsToTenant;

    protected static function booted()
    {
        parent::creating(function (Invite $invite) {
            $invite->passes ??= 1;
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
        return Attachment::fromUrl(url()->signedRoute('invites.show', $this))
            ->as(str($this->name)->slug()->finish('.pdf'))
            ->withMime('application/pdf');
    }

    public function whatsappUrl(): string
    {
        $notification = (new InvitePass)->toWhatsapp($this);

        $text = collect($notification->introLines)->implode("\n\n");

        return 'https://api.whatsapp.com/send?text='.urlencode($text);
    }
}
