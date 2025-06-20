<?php

use App\Exports\InviteExport;
use App\Http\Controllers\CheckedInviteController;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SentInviteController;
use App\Http\Controllers\VerifiedInviteController;
use App\Imports\InviteImport;
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

        Route::resource('invites', InviteController::class)->only('store', 'destroy');

        Route::post('/invites/{invite}/send', [SentInviteController::class, 'store'])
            ->name('invites.send');

        Route::get('/invites/{invite}/whatsapp', [SentInviteController::class, 'create'])
            ->name('invites.whatsapp');

        Route::get('/invites/{invite}/checkin', [CheckedInviteController::class, 'create'])
            ->name('invites.checkin');

        Route::get('/export', InviteExport::class)->name('export');
        Route::post('/import', InviteImport::class)->name('invites.import');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::get('/invites/{invite}.pdf', [InviteController::class, 'show'])->name('invites.show');

    Route::get('/invites/{invite}/verify', [VerifiedInviteController::class, 'create'])
        ->name('invites.verify');

    Route::get('/shoot', function () {
        dd(config('app.name'), tenant());
        //Notification::route('mail', 'adesolaadebisi@gmail.com')->notify(new InviteFollowup);
        //Notification::send(Invite::whereNotNull('email')->latest()->take(50)->get(), new InviteFollowup);
    });

    require __DIR__ . '/auth.php';
});
