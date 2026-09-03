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
use App\Http\Controllers\MstHukdisController;
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
    Route::get('/list-students', [PiketController::class, 'listStudents'])->name('detail-siswa');
    Route::get('/piket', [PiketController::class, 'index'])->name('piket.index')->middleware('piket');
    Route::get('/piket/list-students', [PiketController::class, 'listStudents'])->name('piket.list-students')->middleware('piket');
    Route::get('piket/hukdis', [HukdisController::class, 'index'])->name('piket.hukdis')->middleware('piket');
    Route::get('/piket/status-absensi', [PiketController::class, 'statusAbsensi'])->name('piket.status_absensi')->middleware('piket');
    // Guru Mapel Routes
    Route::get('gurumapel', [App\Http\Controllers\GuruMapelController::class, 'index'])->name('gurumapel.index');
    Route::get('gurumapel/kelas/{id_penetapan}', [App\Http\Controllers\GuruMapelController::class, 'showKelas'])->name('gurumapel.show_kelas');
    Route::post('gurumapel/kelas/{id_penetapan}/simpan', [App\Http\Controllers\GuruMapelController::class, 'storeCatatan'])->name('gurumapel.store_catatan');
    Route::get('gurumapel/kelas/{id_penetapan}/riwayat', [App\Http\Controllers\GuruMapelController::class, 'riwayatKelas'])->name('gurumapel.riwayat');
    Route::get('gurumapel/pertemuan/{id_pertemuan}/detail', [App\Http\Controllers\GuruMapelController::class, 'detailRiwayat'])->name('gurumapel.detail_riwayat');
    Route::get('gurumapel/pertemuan/{id_pertemuan}/edit', [App\Http\Controllers\GuruMapelController::class, 'editPertemuan'])->name('gurumapel.edit_pertemuan');
    Route::post('gurumapel/pertemuan/{id_pertemuan}/update', [App\Http\Controllers\GuruMapelController::class, 'updatePertemuan'])->name('gurumapel.update_pertemuan');
    Route::get('gurumapel/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

    // Siswa Routes
    Route::get('siswa/dashboard', [App\Http\Controllers\StudentDashboardController::class, 'index'])->name('siswa.dashboard');
    Route::post('siswa/profile/update', [App\Http\Controllers\StudentDashboardController::class, 'updateProfile'])->name('siswa.profile.update');
    Route::get('siswa/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

    Route::get('/piket/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

    Route::get('/walikelas', [WalikelasController::class, 'index'])->name('walas.index');
    Route::get('/walikelas/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/guess', function () {
        $tahun = TahunService::getActive()->alias_tahun;
        return view('guess', ['tahun' => $tahun]);
    });
    Route::get('/guess/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/admin/dashboard', [LoginController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/userman', [UsermanController::class, 'index'])->name('userman.index')->middleware('admin');
    Route::post('userman/destroy/{id}/', [UsermanController::class, 'destroy'])->name('userman.remove')->middleware('admin');
    Route::post('userman/store', [UsermanController::class, 'store'])->name('userman.store')->middleware('admin');
    Route::post('userman/upload-csv', [UsermanController::class, 'uploadCSV'])->name('userman.upload_csv')->middleware('admin');
    // Siswa Routes (Admin Side)
    Route::post('siswa/generate-accounts', [App\Http\Controllers\SiswaController::class, 'generateAccounts'])->name('siswa.generate-accounts')->middleware('admin');
    Route::get('userman/download-template', [UsermanController::class, 'downloadTemplate'])->name('userman.download_template')->middleware('admin');
    Route::get('userman/roles/{id}', [UsermanController::class, 'getUserRoles'])->name('userman.roles')->middleware('admin');
    Route::post('userman/assign-roles/{id}', [UsermanController::class, 'assignRoles'])->name('userman.assign_roles')->middleware('admin');

    // Role Management
    Route::resource('roles', App\Http\Controllers\RoleController::class)->except(['create', 'show'])->middleware('admin');
    Route::get('userman/{id}', [UsermanController::class, 'show'])->name('userman.show')->middleware('admin');
    Route::post('userman/reset/{id}', [UsermanController::class, 'reset'])->name('userman.reset')->middleware('admin');

    // Manajemen Menu
    Route::resource('menus', App\Http\Controllers\MenuController::class)->except(['create', 'edit', 'show'])->middleware('admin');

    Route::get('/tahun', [TahunAkademikController::class, 'index'])->name('tahun.index')->middleware('admin');
    Route::post('/tahun/ajaxAdd', [TahunAkademikController::class, 'add'])->name('tahun.add')->middleware('admin');
    Route::post('/tahun/ajaxSetActive', [TahunAkademikController::class, 'setActive'])->name('tahun.set')->middleware('admin');

    Route::middleware('tahun')->group(function () {
        Route::get('/mst_hukdis', [MstHukdisController::class, 'index'])->name('mst_hukdis.index');
        Route::post('/mst_hukdis', [MstHukdisController::class, 'store'])->name('mst_hukdis.store');
        Route::get('/mst_hukdis/{id}/edit', [MstHukdisController::class, 'edit'])->name('mst_hukdis.edit');
        Route::delete('/mst_hukdis/{id}', [MstHukdisController::class, 'destroy'])->name('mst_hukdis.destroy');
        Route::post('/mst_hukdis/upload', [MstHukdisController::class, 'uploadCSV'])->name('mst_hukdis.upload');
        Route::get('/mst_hukdis/download/template', [MstHukdisController::class, 'downloadTemplate'])->name('mst_hukdis.template');

        Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index')->middleware('admin:admin,akademik');
        Route::get('/kelas/show', [KelasController::class, 'show'])->name('kelas.show')->middleware('admin:admin,akademik');
        Route::post('/kelas', [KelasController::class, 'add'])->name('kelas.add')->middleware('admin:admin,akademik'); #create /update
        Route::delete('/kelas', [KelasController::class, 'destroy'])->name('kelas.destroy')->middleware('admin:admin,akademik');

        // Mapel Routes
        Route::get('/master/mapel', [App\Http\Controllers\MstMapelController::class, 'index'])->name('master.mapel.index')->middleware('admin:admin,akademik');
        Route::get('/master/mapel/show', [App\Http\Controllers\MstMapelController::class, 'show'])->name('master.mapel.show')->middleware('admin:admin,akademik');
        Route::post('/master/mapel/add', [App\Http\Controllers\MstMapelController::class, 'add'])->name('master.mapel.add')->middleware('admin:admin,akademik');
        Route::delete('/master/mapel/destroy', [App\Http\Controllers\MstMapelController::class, 'destroy'])->name('master.mapel.destroy')->middleware('admin:admin,akademik');
        Route::post('/master/mapel/upload', [App\Http\Controllers\MstMapelController::class, 'uploadCSV'])->name('master.mapel.upload')->middleware('admin:admin,akademik');
        Route::get('/master/mapel/download/template', [App\Http\Controllers\MstMapelController::class, 'downloadTemplate'])->name('master.mapel.template')->middleware('admin:admin,akademik');

        // Penetapan Guru Mapel Routes
        Route::get('/master/penetapan-guru-mapel', [App\Http\Controllers\PenetapanGuruMapelController::class, 'index'])->name('master.penetapan.index')->middleware('admin:admin,akademik');
        Route::get('/master/penetapan-guru-mapel/show', [App\Http\Controllers\PenetapanGuruMapelController::class, 'show'])->name('master.penetapan.show')->middleware('admin:admin,akademik');
        Route::get('/master/penetapan-guru-mapel/get-kelas', [App\Http\Controllers\PenetapanGuruMapelController::class, 'getKelas'])->name('master.penetapan.get_kelas')->middleware('admin:admin,akademik');
        Route::post('/master/penetapan-guru-mapel/add', [App\Http\Controllers\PenetapanGuruMapelController::class, 'add'])->name('master.penetapan.add')->middleware('admin:admin,akademik');
        Route::delete('/master/penetapan-guru-mapel/destroy', [App\Http\Controllers\PenetapanGuruMapelController::class, 'destroy'])->name('master.penetapan.destroy')->middleware('admin:admin,akademik');
    });


    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('profile/change_pass', [ProfileController::class, 'change_pass'])->name('profile.change_pass');
    Route::post('profile/update_name', [ProfileController::class, 'update_name'])->name('profile.update_name');

    Route::get('/login/registration', [LoginController::class, 'registration'])->name('registration')->middleware('admin');
    Route::post('/login/validate_registration', [LoginController::class, 'validate_registration'])->name('login.validate_registration');

    Route::get('siswa', [SiswaController::class, 'index'])->name('siswa.index')->middleware('admin:admin,akademik');
    Route::post('siswa/upload-csv', [SiswaController::class, 'uploadCSV'])->name('siswa.upload_csv')->middleware('admin:admin,akademik');
    Route::get('siswa/download-template', [SiswaController::class, 'downloadTemplate'])->name('siswa.download_template')->middleware('admin:admin,akademik');
    Route::get('siswa/{id}', [SiswaController::class, 'show'])->name('siswa.show')->middleware('admin:admin,akademik');
    Route::post('siswa/destroy/{id}/', [SiswaController::class, 'destroy'])->name('siswa.remove')->middleware('admin:admin,akademik');
    Route::post('siswa/store', [SiswaController::class, 'store'])->name('siswa.store')->middleware('admin:admin,akademik');
    Route::get('siswa/removeall', [SiswaController::class, 'removeall'])->name('siswa.removeall')->middleware('admin:admin,akademik');

    Route::middleware('tahun')->group(function () {
        Route::get('grouping', [GroupingController::class, 'index'])->name('grouping.index')->middleware('admin:admin,akademik');
        Route::get('grouping/create', [GroupingController::class, 'create'])->name('grouping.create')->middleware('admin:admin,akademik');
        Route::get('grouping/createall', [GroupingController::class, 'createall'])->name('grouping.createall')->middleware('admin:admin,akademik');
        Route::get('grouping/store', [GroupingController::class, 'store'])->name('grouping.store')->middleware('admin:admin,akademik');
        Route::get('grouping/ajaxbykelas', [GroupingController::class, 'ajaxbykelas'])->name('grouping.ajaxbykelas')->middleware('admin:admin,akademik');
        Route::get('grouping/export-csv', [GroupingController::class, 'exportCsv'])->name('grouping.exportCsv')->middleware('admin:admin,akademik');
        Route::post('grouping/ajaxdestroy', [GroupingController::class, 'ajaxdestroy'])->name('grouping.ajaxdestroy')->middleware('admin:admin,akademik');

        Route::get('setwalas', [PenetapanWalasController::class, 'index'])->name('setwalas.index')->middleware('admin:admin,akademik');

        Route::get('presensi', [PresensiController::class, 'index'])->name('presensi.index')->middleware('tahun');
        Route::get('presensi/ajaxkelastanggal', [PresensiController::class, 'ajaxkelastanggal'])->name('presensi.ajaxkelastanggal');
        Route::post('presensi', [PresensiController::class, 'store'])->name('presensi.store');
        Route::post('presensi/selesai', [PresensiController::class, 'selesaiAbsen'])->name('presensi.selesai');
        Route::DELETE('presensi', [PresensiController::class, 'ajaxdestroy'])->name('presensi.ajaxdestroy');
        Route::get('presensi/show_all', [PresensiController::class, 'list_all'])->name('presensi.show_all')->middleware('tahun');
        Route::get('presensi/ajax_list_by', [PresensiController::class, 'ajax_list_by'])->name('presensi.all');
        Route::get('presensi/monitoring-piket', [\App\Http\Controllers\PiketController::class, 'monitoringKesiswaan'])->name('presensi.monitoring_piket');
        Route::get('presensi/rekap', [LaporanPresensiController::class, 'index'])->name('presensi.rekap');
        Route::get('presensi/rekap_bulanan', [RekapPresensiController::class, 'index'])->name('presensi.bulanan');

        // MBG Module Routes
        Route::get('mbg', [\App\Http\Controllers\MbgController::class, 'index'])->name('mbg.index');
        Route::get('mbg/kelas/{id}', [\App\Http\Controllers\MbgController::class, 'getKelasData'])->name('mbg.get_kelas');
        Route::post('mbg/checkout', [\App\Http\Controllers\MbgController::class, 'checkout'])->name('mbg.checkout');
        Route::post('mbg/checkin', [\App\Http\Controllers\MbgController::class, 'checkin'])->name('mbg.checkin');

        Route::get('mbg-rekap', [\App\Http\Controllers\MbgController::class, 'rekap'])->name('mbg.rekap');
        Route::get('mbg-rekap/data', [\App\Http\Controllers\MbgController::class, 'getRekap'])->name('mbg.rekap.data');

        Route::get('pelanggaran/rekap', [\App\Http\Controllers\LaporanPelanggaranController::class, 'index'])->name('pelanggaran.rekap');

        // IZIN KELUAR (Guru Mapel)
        Route::get('izin-keluar/guru', [\App\Http\Controllers\IzinKeluarGuruController::class, 'index'])->name('guru.izin_keluar.index');
        Route::get('izin-keluar/guru/create', [\App\Http\Controllers\IzinKeluarGuruController::class, 'create'])->name('guru.izin_keluar.create');
        Route::post('izin-keluar/guru/store', [\App\Http\Controllers\IzinKeluarGuruController::class, 'store'])->name('guru.izin_keluar.store');
        Route::get('izin-keluar/guru/search', [\App\Http\Controllers\IzinKeluarGuruController::class, 'searchSiswa'])->name('guru.izin_keluar.search');

        // IZIN KELUAR (Piket)
        Route::get('izin-keluar/piket', [\App\Http\Controllers\IzinKeluarPiketController::class, 'index'])->name('piket.izin_keluar.index');
        Route::post('izin-keluar/piket/approve/{id}', [\App\Http\Controllers\IzinKeluarPiketController::class, 'approve'])->name('piket.izin_keluar.approve');
        Route::post('izin-keluar/piket/kembali/{id}', [\App\Http\Controllers\IzinKeluarPiketController::class, 'kembali'])->name('piket.izin_keluar.kembali');
        Route::get('izin-keluar/piket/cetak/{id}', [\App\Http\Controllers\IzinKeluarPiketController::class, 'cetakSurat'])->name('piket.izin_keluar.cetak');
        Route::get('izin-keluar/rekap', [\App\Http\Controllers\IzinKeluarPiketController::class, 'rekap'])->name('piket.izin_keluar.rekap');
        Route::get('izin-keluar/rekap/data', [\App\Http\Controllers\IzinKeluarPiketController::class, 'getRekap'])->name('piket.izin_keluar.rekap.data');

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
    });









    Route::get('error/admin_only', function () {
        return view('error.restricted');
    })->name('error.admin_only');

    Route::get('error/tahun_aktif', function () {
        return view('error.no_tahun_aktif');
    })->name('error.no_tahun_aktif');
});


Route::get('test', [TahunAkademikController::class, 'setActive']);

require __DIR__ . '/ajax.php';
