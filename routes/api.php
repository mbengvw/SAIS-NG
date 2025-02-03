<?php

use App\Http\Controllers\ApiSiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::POST('/siswa-nisn', [ApiSiswaController::class, 'showByNisn']);
Route::POST('/siswa-nis', [ApiSiswaController::class, 'showByNis']);

Route::get('/list-siswa/{tahun}',[ApiSiswaController::class,'listByTahun']);

