<?php

use App\Http\Controllers\guestsController;
use App\Http\Controllers\logsController;
use App\Http\Controllers\messagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\repliesController;
use App\Http\Controllers\settingsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('guests', guestsController::class)->middleware('auth');
Route::resource('messages', messagesController::class)->middleware('auth');
Route::resource('replies', repliesController::class)->middleware('auth');
Route::resource('logs', logsController::class)->middleware('auth');
Route::resource('settings', settingsController::class)->middleware('auth');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
