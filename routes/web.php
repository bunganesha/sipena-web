<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\LaporanController;

use App\Models\Pegawai;
use App\Models\Absensi;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
| WEB ROUTES
|--------------------------------------------------------------------------
*/


// ====================== AUTH ======================

Route::get('/login', [AuthController::class, 'index'])
    ->name('login');

Route::post('/login', [AuthController::class, 'authenticate']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


// ====================== DASHBOARD ======================

Route::middleware(['auth', 'role:hrd'])
    ->get('/dashboard/hrd', function () {

    $totalPegawai = Pegawai::count();

    $hadir = Absensi::where('status_absensi', 'hadir')->count();

    $izin = Absensi::where('status_absensi', 'izin')->count();

    $sakit = Absensi::where('status_absensi', 'sakit')->count();

    $cuti = Absensi::where('status_absensi', 'cuti')->count();

    $alpha = Absensi::where('status_absensi', 'alpha')->count();

    return view('dashboard.index', compact(
        'totalPegawai',
        'hadir',
        'izin',
        'sakit',
        'cuti',
        'alpha'
    ));
});

Route::middleware(['auth', 'role:manager'])
    ->get('/dashboard/manager', function () {

    $totalPegawai = Pegawai::count();

    $hadir = Absensi::where('status_absensi', 'hadir')->count();

    $izin = Absensi::where('status_absensi', 'izin')->count();

    $sakit = Absensi::where('status_absensi', 'sakit')->count();

    $cuti = Absensi::where('status_absensi', 'cuti')->count();

    $alpha = Absensi::where('status_absensi', 'alpha')->count();

    return view('dashboard.index', compact(
        'totalPegawai',
        'hadir',
        'izin',
        'sakit',
        'cuti',
        'alpha'
    ));
});

Route::middleware(['auth', 'role:spv'])
    ->get('/dashboard/spv', function () {

    $totalPegawai = Pegawai::count();

    $hadir = Absensi::where('status_absensi', 'hadir')->count();

    $izin = Absensi::where('status_absensi', 'izin')->count();

    $sakit = Absensi::where('status_absensi', 'sakit')->count();

    $cuti = Absensi::where('status_absensi', 'cuti')->count();

    $alpha = Absensi::where('status_absensi', 'alpha')->count();

    return view('dashboard.index', compact(
        'totalPegawai',
        'hadir',
        'izin',
        'sakit',
        'cuti',
        'alpha'
    ));
});

Route::middleware(['auth', 'role:pegawai'])
    ->get('/dashboard/pegawai', function () {

    $totalPegawai = Pegawai::count();

    $hadir = Absensi::where('status_absensi', 'hadir')->count();

    $izin = Absensi::where('status_absensi', 'izin')->count();

    $sakit = Absensi::where('status_absensi', 'sakit')->count();

    $cuti = Absensi::where('status_absensi', 'cuti')->count();

    $alpha = Absensi::where('status_absensi', 'alpha')->count();

    return view('dashboard.index', compact(
        'totalPegawai',
        'hadir',
        'izin',
        'sakit',
        'cuti',
        'alpha'
    ));
});


// ====================== PEGAWAI ======================

Route::middleware(['auth', 'role:hrd'])->group(function () {

    Route::prefix('pegawai')->name('pegawai.')->group(function () {

        Route::get('/', [PegawaiController::class, 'index'])
            ->name('index');

        Route::post('/', [PegawaiController::class, 'store'])
            ->name('store');

        Route::put('/{id}', [PegawaiController::class, 'update'])
            ->name('update');

        Route::delete('/{id}', [PegawaiController::class, 'destroy'])
            ->name('destroy');

    });

});


// ====================== USER ======================

Route::middleware(['auth', 'role:hrd'])->group(function () {

    Route::prefix('user')->name('user.')->group(function () {

        Route::get('/', [UserController::class, 'index'])
            ->name('index');

        Route::post('/', [UserController::class, 'store'])
            ->name('store');

        Route::put('/{id}', [UserController::class, 'update'])
            ->name('update');

        Route::delete('/{id}', [UserController::class, 'destroy'])
            ->name('destroy');

    });

});


// ====================== PENGAJUAN ======================

Route::middleware(['auth', 'role:pegawai'])->group(function () {

    Route::prefix('pengajuan')->name('pengajuan.')->group(function () {

        Route::get('/', [PengajuanController::class, 'index'])
            ->name('index');

        Route::post('/', [PengajuanController::class, 'store'])
            ->name('store');

        Route::put('/{id}', [PengajuanController::class, 'update'])
            ->name('update');

        Route::delete('/{id}', [PengajuanController::class, 'destroy'])
            ->name('destroy');

    });
    Route::get('/absensi-saya', [AbsensiController::class, 'absensiSaya']) ->name('absensi.saya');

});


// ====================== ABSENSI ======================

Route::middleware(['auth', 'role:hrd'])->group(function () {

    Route::prefix('absensi')->name('absensi.')->group(function () {

        Route::get('/', [AbsensiController::class, 'index'])
            ->name('index');

        Route::get('/create', [AbsensiController::class, 'create'])
            ->name('create');

        Route::post('/', [AbsensiController::class, 'store'])
            ->name('store');

        Route::get('/{id}/edit', [AbsensiController::class, 'edit'])
            ->name('edit');

        Route::put('/{id}', [AbsensiController::class, 'update'])
            ->name('update');

        Route::delete('/{id}', [AbsensiController::class, 'destroy'])
            ->name('destroy');

        Route::post('/import', [AbsensiController::class, 'import'])
            ->name('import');

    });

});


// ====================== APPROVAL ======================

Route::middleware(['auth', 'role:hrd,manager,spv'])->group(function () {

    Route::prefix('approval')->name('approval.')->group(function () {

        Route::get('/', [ApprovalController::class, 'index'])
            ->name('index');

        Route::get('/{id}/edit', [ApprovalController::class, 'edit'])
            ->name('edit');

        Route::put('/{id}', [ApprovalController::class, 'update'])
            ->name('update');

    });

});


// ====================== LAPORAN ======================

Route::middleware(['auth', 'role:hrd,manager'])->group(function () {

    Route::get('/laporan', [LaporanController::class, 'index']);

    Route::post('/laporan/export',
        [LaporanController::class, 'export'])
        ->name('laporan.export');

    Route::post('/laporan/export-pdf',
        [LaporanController::class, 'exportPdf'])
        ->name('laporan.export.pdf');

});