<?php

namespace App\Http\Controllers;

use App\Models\Invite;
use Illuminate\Http\Request;

class InviteController extends Controller
{
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

        return response()->json(['message' => 'Invite created.']);
    }

    public function destroy(Invite $invite)
    {
        $invite->delete();

        return response()->json(['message' => 'Invite deleted.']);
    }
}
