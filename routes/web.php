<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PegawaiController;

Route::get('/', [AuthController::class, 'login']);

Route::post('/proses-login', [AuthController::class, 'prosesLogin']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

Route::get('/pegawai', [PegawaiController::class, 'index']);

Route::post('/pegawai/store', [PegawaiController::class, 'store']);

Route::get('/user', function () {
    return view('user.index');
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