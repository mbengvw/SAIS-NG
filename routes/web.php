<?php

use App\Http\Controllers\EmisController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\GroupingController;
use App\Http\Controllers\HukdisController;
use App\Http\Controllers\HukdismanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LaporanPresensiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenetapanWalasController;
use App\Http\Controllers\PiketController;
use App\Http\Controllers\UsermanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekapPresensiController;
use App\Http\Controllers\TahunAkademikController;
use App\Http\Controllers\WalikelasController;
use App\Services\TahunService;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login/validate_login', [LoginController::class, 'validate_login'])->name('login.validate_login');

Route::prefix('public')->group(function () {
    Route::get('/rekap-siswa', [EmisController::class, 'rekap'])->name('emis.rekap');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/piket', [PiketController::class, 'index'])->name('piket.index')->middleware('piket');
    Route::get('/piket/list-students', [PiketController::class, 'listStudents'])->name('piket.list-students')->middleware('piket');
    Route::get('/piket/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/walikelas', [WalikelasController::class, 'index'])->name('walas.index');
    Route::get('/walikelas/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/guess',function(){
        $tahun = TahunService::getActive()->alias_tahun;
        return view('guess',['tahun'=>$tahun]);
    });
    Route::get('/guess/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/admin/dashboard', [LoginController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/userman', [UsermanController::class, 'index'])->name('userman.index')->middleware('admin');
    Route::post('userman/destroy/{id}/', [UsermanController::class, 'destroy'])->name('userman.remove')->middleware('admin');
    Route::post('userman/store', [UsermanController::class, 'store'])->name('userman.store')->middleware('admin');
    Route::get('userman/{id}', [UsermanController::class, 'show'])->name('userman.show')->middleware('admin');
    Route::post('userman/reset/{id}', [UsermanController::class, 'reset'])->name('userman.reset')->middleware('admin');

    Route::get('/tahun', [TahunAkademikController::class, 'index'])->name('tahun.index')->middleware('admin');
    Route::post('/tahun/ajaxAdd', [TahunAkademikController::class, 'add'])->name('tahun.add')->middleware('admin');
    Route::post('/tahun/ajaxSetActive', [TahunAkademikController::class, 'setActive'])->name('tahun.set')->middleware('admin');

    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index')->middleware('admin');
    Route::get('/kelas/show', [KelasController::class, 'show'])->name('kelas.show')->middleware('admin');
    Route::post('/kelas', [KelasController::class, 'add'])->name('kelas.add')->middleware('admin'); #create /update
    Route::delete('/kelas', [KelasController::class, 'destroy'])->name('kelas.destroy')->middleware('admin');

    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('profile/change_pass', [ProfileController::class, 'change_pass'])->name('profile.change_pass');

    Route::get('/login/registration', [LoginController::class, 'registration'])->name('registration')->middleware('admin');
    Route::post('/login/validate_registration', [LoginController::class, 'validate_registration'])->name('login.validate_registration');

    Route::get('siswa', [SiswaController::class, 'index'])->name('siswa.index')->middleware('admin');
    Route::get('siswa/{id}', [SiswaController::class, 'show'])->name('siswa.show')->middleware('admin');
    Route::post('siswa/destroy/{id}/', [SiswaController::class, 'destroy'])->name('siswa.remove')->middleware('admin');
    Route::post('siswa/store', [SiswaController::class, 'store'])->name('siswa.store')->middleware('admin');
    Route::get('siswa/removeall', [SiswaController::class, 'removeall'])->name('siswa.removeall')->middleware('admin');

    Route::get('grouping', [GroupingController::class, 'index'])->name('grouping.index')->middleware('admin');
    Route::get('grouping/create', [GroupingController::class, 'create'])->name('grouping.create')->middleware('admin');
    Route::get('grouping/createall', [GroupingController::class, 'createall'])->name('grouping.createall')->middleware('admin');
    Route::get('grouping/store', [GroupingController::class, 'store'])->name('grouping.store')->middleware('admin');
    Route::get('grouping/ajaxbykelas', [GroupingController::class, 'ajaxbykelas'])->name('grouping.ajaxbykelas')->middleware('admin');
    Route::post('grouping/ajaxdestroy', [GroupingController::class, 'ajaxdestroy'])->name('grouping.ajaxdestroy')->middleware('admin');

    Route::get('setwalas', [PenetapanWalasController::class, 'index'])->name('setwalas.index')->middleware('admin');

    Route::get('presensi', [PresensiController::class, 'index'])->name('presensi.index');
    Route::get('presensi/ajaxkelastanggal', [PresensiController::class, 'ajaxkelastanggal'])->name('presensi.ajaxkelastanggal');
    Route::post('presensi', [PresensiController::class, 'store'])->name('presensi.store');
    Route::DELETE('presensi', [PresensiController::class, 'ajaxdestroy'])->name('presensi.ajaxdestroy');
    Route::get('presensi/show_all', [PresensiController::class, 'list_all'])->name('presensi.show_all');
    Route::get('presensi/ajax_list_by', [PresensiController::class, 'ajax_list_by'])->name('presensi.all');
    Route::get('presensi/rekap', [LaporanPresensiController::class, 'index'])->name('presensi.rekap');
    Route::get('presensi/rekap_bulanan', [RekapPresensiController::class, 'index'])->name('presensi.bulanan');

    Route::get('hukdis', [HukdisController::class, 'index'])->name('hukdis.index');
    Route::get('hukdis/all', [HukdisController::class, 'list_all'])->name('hukdis.all');
    Route::get('hukdis/list_by', [HukdisController::class, 'list_by'])->name('hukdis.list_by');
    Route::get('hukdis/ajax_list_by', [HukdisController::class, 'ajax_list_by'])->name('hukdis.ajax_list_by');
    Route::post('hukdis/store', [HukdisController::class, 'ajaxStore'])->name('hukdis.store');
    Route::post('hukdis/ajaxdestroy', [HukdisController::class, 'ajaxdestroy'])->middleware('ajax_admin');
    Route::get('hukdis/list_siswa_by_tahun/{tahun}', [HukdisController::class, 'list_siswa_by_tahun']);
    Route::get('hukdis/ajax_list_siswa_by_tahun', [HukdisController::class, 'ajax_list_siswa_by_tahun']);

    Route::get('hukdisman', [HukdismanController::class, 'index'])->name('hukdisman.index');
    Route::post('hukdisman/list_by', [HukdismanController::class, 'list_by'])->name('hukdisman.list_by');




    Route::get('error/admin_only', function () {
        return view('error.restricted');
    })->name('error.admin_only');
});


Route::get('test', [TahunAkademikController::class, 'setActive']);

require __DIR__ . '/ajax.php';