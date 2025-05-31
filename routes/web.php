<?php

use App\Http\Controllers\ErrorController;
use App\Http\Controllers\guestsController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanTamuController; 
use App\Http\Controllers\logsController;
use App\Http\Controllers\messageController;
use App\Http\Controllers\PelayananController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('error', ErrorController::class);
Route::resource('guests', guestsController::class)->middleware('auth');
Route::resource('message', messageController::class)->middleware('auth');
Route::resource('kategori', KategoriController::class)->middleware('auth');
Route::resource('logs', logsController::class)->middleware('auth');
Route::resource('pelayanan', PelayananController::class)->middleware('auth');

Route::get('/pelayanan/grafik', [PelayananController::class, 'grafik'])->name('kategori.grafik');

Route::get('laporan-tamu/export', [LaporanTamuController::class, 'export'])->name('laporantamu.export');
Route::get('/laporantamu', [LaporanTamuController::class, 'index'])->name('laporantamu.index');
Route::get('/laporantamu/print', [LaporanTamuController::class, 'print'])->name('laporantamu.print');


Route::get('/profile', [ProfileController::class, 'edit'])->middleware('auth')->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->middleware('auth')->name('profile.destroy');


require __DIR__ . '/auth.php';
