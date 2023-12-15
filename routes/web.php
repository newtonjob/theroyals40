<?php

use App\Http\Controllers\ProfileController;
use App\Models\Invite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/dashboard');

Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::get('/invites/{invite}',
        fn (Invite $invite) => $invite->pdf()->stream()
    )->name('invites.show');

    Route::post('/invites', function (Request $request) {
        $invite = Invite::create($request->validate([
            'name'     => 'required',
            'passes'   => 'required',
            'email'    => 'email',
            'category' => 'required'
        ]));

        if ($request->send) {
            $invite->send();
        }

        return response()->json(['message' => 'Invite created.']);
    })->name('invites.store');

    Route::delete('/invites/{invite}', function (Invite $invite) {
        $invite->delete();

        return response()->json(['message' => 'Invite deleted.']);
    })->name('invites.destroy');

    Route::post('/invites/{invite}/send', function (Invite $invite) {
        $invite->send();

        return response()->json(['message' => 'Invite resent successfully.']);
    })->name('invites.send');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/invites/{invite}/verify', function (Invite $invite) {
    return view('invites.verify', compact('invite'));
})->name('invites.verify');

require __DIR__ . '/auth.php';
