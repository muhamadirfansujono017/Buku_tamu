<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\GuestsController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RepliesController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('error',ErrorController::class);


Route::resource('guests', GuestsController::class)->middleware('auth');
Route::resource('message', MessageController::class)->middleware('auth');
Route::resource('reply', ReplyController::class)->middleware('auth');
Route::resource('logs', LogsController::class)->middleware('auth');
Route::resource('settings', SettingsController::class)->middleware('auth');


Route::get('/profile', [ProfileController::class, 'edit'])->middleware('auth')->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->middleware('auth')->name('profile.destroy');


require __DIR__ . '/auth.php';
