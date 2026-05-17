<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AuthController;
use App\Http\Controllers\PegawaiController;

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

Route::get('/pengajuan', function () {
    return view('pengajuan.index');
});

Route::get('/cuti', function () {
    return view('cuti.index');
});

Route::get('/izin', function () {
    return view('izin.index');
});

Route::get('/sakit', function () {
    return view('sakit.index');
});

Route::get('/laporan', function () {
    return view('laporan.index');
});