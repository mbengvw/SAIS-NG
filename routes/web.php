<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ProductAjaxController;
// use App\Http\Controllers\StudentController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\GroupingController;
use App\Http\Controllers\HukdisController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('siswa', [SiswaController::class, 'index'])->name('siswa.index');
Route::get('siswa/{id}', [SiswaController::class, 'show'])->name('siswa.show');
Route::post('siswa/destroy/{id}/', [SiswaController::class, 'destroy'])->name('siswa.remove');
Route::post('siswa/store', [SiswaController::class, 'store'])->name('siswa.store');
Route::get('siswa/removeall', [SiswaController::class, 'removeall'])->name('siswa.removeall');



Route::get('grouping', [GroupingController::class, 'index'])->name('grouping.index');
Route::get('grouping/create', [GroupingController::class, 'create'])->name('grouping.create');
Route::get('grouping/createall', [GroupingController::class, 'createall'])->name('grouping.createall');
Route::get('grouping/store', [GroupingController::class, 'store'])->name('grouping.store');
Route::get('grouping/ajaxbykelas', [GroupingController::class, 'ajaxbykelas'])->name('grouping.ajaxbykelas');
Route::post('grouping/ajaxdestroy', [GroupingController::class, 'ajaxdestroy'])->name('grouping.ajaxdestroy');

Route::get('presensi', [PresensiController::class, 'index'])->name('presensi.index');
Route::get('presensi/ajaxkelastanggal', [PresensiController::class, 'ajaxkelastanggal'])->name('presensi.ajaxkelastanggal');
Route::post('presensi/store', [PresensiController::class, 'store'])->name('presensi.store');
Route::post('presensi/ajaxdestroy', [PresensiController::class, 'ajaxdestroy'])->name('presensi.ajaxdestroy');
Route::get('presensi/all', [PresensiController::class, 'list_all'])->name('presensi.all');
Route::post('presensi/ajax_list_by', [PresensiController::class, 'ajax_list_by'])->name('presensi.all');

Route::get('hukdis', [HukdisController::class, 'index'])->name('hukdis.index');
Route::get('hukdis/list_by', [HukdisController::class, 'list_by'])->name('hukdis.list_by');
Route::get('hukdis/list_siswa_by_tahun/{tahun}', [HukdisController::class, 'list_siswa_by_tahun']);


Route::get('presensi/test', [PresensiController::class, 'test'])->name('presensi.test');
Route::get('presensi/list_by', [PresensiController::class, 'list_by'])->name('presensi.list_by');

// Route::get('presensi/{id}', [PresensiController::class, 'show'])->name('presensi.show');
// Route::post('presensi/destroy/{id}/', [PresensiController::class, 'destroy'])->name('presensi.remove');
// Route::post('presensi/store', [PresensiController::class, 'store'])->name('presensi.store');



Route::get('presensi/test', [PresensiController::class, 'test'])->name('presensi.test');
