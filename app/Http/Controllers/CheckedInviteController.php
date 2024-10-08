<?php

namespace App\Http\Controllers;

use App\Models\Invite;
use Illuminate\Http\RedirectResponse;

class CheckedInviteController extends Controller
{
    public function create(Invite $invite): RedirectResponse
    {
        info("Checked Invite: {$invite->id}");

        if ($invite->remaining < 1) {
            return to_route('invites.verify', $invite);
        }

        $invite->decrement('remaining');

        return to_route('invites.verify', [$invite, 'checked' => true]);
    }
}
