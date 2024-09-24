<?php

namespace App\Http\Controllers;

use App\Models\Invite;
use Facades\App\Support\Pdf;
use Illuminate\Http\Request;

class InviteController extends Controller
{
    public function __construct()
    {
        $this->middleware('signed')->only('show');
    }

    public function show(Invite $invite)
    {
        return Pdf::margin(0)
            ->format([215, 200])
            ->name($invite->name)
            ->render('invites.show', ['invite' => $invite]);
    }

    public function store(Request $request)
    {
        $invite = Invite::create($request->validate([
            'name'      => 'required',
            'passes'    => 'required',
            'email'     => 'nullable|email',
            'category'  => 'required'
        ]));

        if ($request->email && $request->send) {
            $invite->send();
        }

        return ['message' => 'Invite created.'];
    }

    public function destroy(Invite $invite)
    {
        $invite->delete();

        return ['message' => 'Invite deleted.'];
    }
}
