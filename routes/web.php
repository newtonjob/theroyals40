<?php

use App\Http\Controllers\ProfileController;
use App\Models\Invite;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', ['invites' => Invite::all()]);
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/invites/{invite}', function (Invite $invite) {
   return Facades\App\Support\Pdf::margin(0)
       ->format([200, 200])
       ->name($invite->name)
       ->render('invites.show', compact('invite'));
})->name('invites.show');

Route::get('/invites/{invite}/verify', function (Invite $invite) {
   return view('invites.verify', compact('invite'));
})->name('invites.verify');

require __DIR__.'/auth.php';
