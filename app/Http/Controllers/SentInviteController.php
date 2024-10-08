<?php

namespace App\Http\Controllers;

use App\Models\Invite;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class SentInviteController extends Controller
{
    public function store(Invite $invite): JsonResponse
    {
        $invite->send();

        return response()->json(['message' => 'Invite successfully resent']);
    }

    public function create(Invite $invite): RedirectResponse
    {
        return redirect()->away($invite->markSent()->whatsappUrl());
    }
}
