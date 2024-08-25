<?php

use App\Http\Controllers\LaporanPresensiController;
use App\Http\Controllers\PenetapanWalasController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::prefix('ajax')->group(function () {
        Route::GET('/walas', [PenetapanWalasController::class, 'listAll']);
        Route::POST('/walas', [PenetapanWalasController::class, 'create']);
        Route::DELETE('/walas', [PenetapanWalasController::class, 'destroy']);

        Route::GET('/rekap_presensi', [LaporanPresensiController::class, 'getRekapPresensi']);
    });

});
