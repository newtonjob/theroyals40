<?php

namespace App\Http\Controllers;

use App\Models\Invite;
use Illuminate\View\View;

class VerifiedInviteController extends Controller
{
    public function create(Invite $invite): View
    {
        info("Verified Invite: {$invite->id}");

        return view('invites.verify', compact('invite'));
    }
}
