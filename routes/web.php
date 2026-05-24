<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AuthController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengajuanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route::get('/', [AuthController::class, 'login']);

// Route::post('/proses-login', [AuthController::class, 'prosesLogin']);

// Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

Route::prefix('pegawai')->name('pegawai.')->group(function () {
    Route::get('/', [PegawaiController::class, 'index'])->name('index');
    Route::post('/', [PegawaiController::class, 'store'])->name('store');
    Route::put('/{id}', [PegawaiController::class, 'update'])->name('update');
    Route::delete('/{id}', [PegawaiController::class, 'destroy'])->name('destroy');
});

Route::prefix('user')->name('user.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::put('/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
});

Route::prefix('pengajuan')->name('pengajuan.')->group(function () {
    Route::get('/', [PengajuanController::class, 'index'])->name('index');
    Route::post('/', [PengajuanController::class, 'store'])->name('store');
    Route::put('/{id}', [PengajuanController::class, 'update'])->name('update');
    Route::delete('/{id}', [PengajuanController::class, 'destroy'])->name('destroy');
});

Route::get('/absensi', function () {
    return view('absensi.index');
});

Route::get('/approval', function () {
    return view('approval.index');
});

Route::get('/laporan', function () {
    return view('laporan.index');
});