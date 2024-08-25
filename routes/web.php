<?php

use App\Exports\InviteExport;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CentralDomain;
use App\Http\Middleware\StartTenancy;
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

Route::view('/', 'welcome')->middleware(CentralDomain::class);

Route::middleware(StartTenancy::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::view('/dashboard', 'dashboard')->name('dashboard');

        Route::post('/invites', [InviteController::class, 'store'])->name('invites.store');
        Route::delete('/invites/{invite}', [InviteController::class, 'destroy'])->name('invites.destroy');

        Route::post('/invites/{invite}/send', function (Invite $invite) {
            $invite->send();

            return response()->json(['message' => 'Invite resent successfully.']);
        })->name('invites.send');

        Route::get('/invites/{invite}/checkin', function (Invite $invite) {
            info("Checked in Invite: {$invite->id}");

            if ($invite->remaining < 1) {
                return to_route('invites.verify', $invite);
            }

            $invite->decrement('remaining');

            return to_route('invites.verify', [$invite, 'checked' => true]);
        })->name('invites.checkin');

        Route::get('/export', fn () => new InviteExport)->name('export');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::get('/invites/{invite}', function (Invite $invite) {
        return $invite->pdf()->stream();
    })->middleware('signed')->name('invites.show');

    Route::get('/invites/{invite}/verify', function (Invite $invite) {
        info("Verified Invite: {$invite->id}");

        return view('invites.verify', compact('invite'));
    })->name('invites.verify');

    Route::get('/shoot', function () {
        //Notification::route('mail', 'adesolaadebisi@gmail.com')->notify(new InviteFollowup);
        Notification::send(Invite::whereNotNull('email')->latest()->take(50)->get(), new InviteFollowup);
    });

    require __DIR__ . '/auth.php';
});
