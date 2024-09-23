<?php

use App\Http\Controllers\LaporanPresensiController;
use App\Http\Controllers\PenetapanWalasController;
use App\Http\Controllers\PiketController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::prefix('ajax')->group(function () {
        Route::GET('/walas', [PenetapanWalasController::class, 'listAll']);
        Route::POST('/walas', [PenetapanWalasController::class, 'create']);
        Route::DELETE('/walas', [PenetapanWalasController::class, 'destroy']);

        Route::GET('/rekap_presensi', [LaporanPresensiController::class, 'getRekapPresensi']);
        Route::GET('/rekap_presensi_bulanan', [LaporanPresensiController::class, 'getRekapPresensiBulanan']);

        Route::GET('/list_siswa', [PiketController::class, 'listStudents']);

        Route::GET('siswa/detail/{id_siswa}', [SiswaController::class, 'detail'])->name('siswa.detail');

    });

});
