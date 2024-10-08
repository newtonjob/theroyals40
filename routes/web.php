<?php

use App\Exports\InviteExport;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\ProfileController;
use App\Imports\InviteImport;
use App\Models\Invite;
use App\Notifications\InviteFollowup;
use Illuminate\Support\Facades\Notification;
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

Route::view('/', 'welcome')->middleware('central');

Route::middleware('tenant')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::view('/dashboard', 'dashboard')->name('dashboard');

        Route::delete('/invites/{invite}', [InviteController::class, 'destroy'])->name('invites.destroy');
        Route::post('/invites', [InviteController::class, 'store'])->name('invites.store');

        Route::post('/invites/{invite}/send', function (Invite $invite) {
            $invite->send();

            return response()->json(['message' => 'Invite resent successfully.']);
        })->name('invites.send');

        Route::get('/invites/{invite}/whatsapp', function (Invite $invite) {
            return redirect()->away($invite->markSent()->whatsappUrl());
        })->name('invites.whatsapp');

        Route::get('/invites/{invite}/checkin', function (Invite $invite) {
            info("Checked in Invite: {$invite->id}");

            if ($invite->remaining < 1) {
                return to_route('invites.verify', $invite);
            }

            $invite->decrement('remaining');

            return to_route('invites.verify', [$invite, 'checked' => true]);
        })->name('invites.checkin');

        Route::get('/export', InviteExport::class)->name('export');
        Route::post('/import', InviteImport::class)->name('invites.import');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::get('/invites/{invite}.pdf', [InviteController::class, 'show'])->name('invites.show');

    Route::get('/invites/{invite}/verify', function (Invite $invite) {
        info("Verified Invite: {$invite->id}");

        return view('invites.verify', compact('invite'));
    })->name('invites.verify');

    Route::get('/shoot', function () {
        dd(config('app.name'), tenant());
        //Notification::route('mail', 'adesolaadebisi@gmail.com')->notify(new InviteFollowup);
        //Notification::send(Invite::whereNotNull('email')->latest()->take(50)->get(), new InviteFollowup);
    });

    require __DIR__ . '/auth.php';
});
