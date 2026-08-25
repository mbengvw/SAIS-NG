<?php

namespace App\Http\Controllers;

use App\Services\KelasService;
use App\Services\RekapPelanggaranService;
use App\Services\TahunService;
use App\Services\WalikelasService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LaporanPelanggaranController extends Controller
{
    private RekapPelanggaranService $rekapPelanggaranService;

    public function __construct(RekapPelanggaranService $rekapPelanggaranService)
    {
        $this->rekapPelanggaranService = $rekapPelanggaranService;
    }

    public function index()
    {
        $data_tahun = TahunService::getActive();
        $tahun = $data_tahun->tahun;
        $user = auth()->user();

        if ($user->hasAnyRole(['admin', 'guru-piket'])) {
            $list_kelas = KelasService::listKelasByTahun($tahun);
        } else if (WalikelasService::isWalikelas($user->id, $data_tahun->id)) {
            $id_kelas = WalikelasService::getIdKelas($user->id, $data_tahun->id);
            $list_kelas = KelasService::listKelasById($id_kelas);
        } else {
            $list_kelas = collect([]);
        }

        return view('hukdis.rekap_tab', ['list_kelas' => $list_kelas, 'data_tahun' => $data_tahun]);
    }

    private function getAccessibleKelas($request, $data_tahun)
    {
        $id_kelas = $request->input('id_kelas'); // Will be null if empty string sent from frontend
        $user = auth()->user();

        if ($user->hasAnyRole(['admin', 'guru-piket'])) {
            return $id_kelas; // Allows null for "Semua Kelas"
        }

        if (WalikelasService::isWalikelas($user->id, $data_tahun->id)) {
            return WalikelasService::getIdKelas($user->id, $data_tahun->id);
        }

        return false; // Unauthorized
    }

    public function getRekapHarian(Request $request)
    {
        if ($request->ajax()) {
            $data_tahun = TahunService::getActive();
            $id_kelas = $this->getAccessibleKelas($request, $data_tahun);
            if ($id_kelas === false) return DataTables::of(collect([]))->make(true);

            $tanggal = $request->input('tanggal', date('Y-m-d'));
            $data = $this->rekapPelanggaranService->rekapHarian($id_kelas, $data_tahun->id, $tanggal);

            return DataTables::of($data)->addIndexColumn()->make(true);
        }
    }

    public function getRekapRentangWaktu(Request $request)
    {
        if ($request->ajax()) {
            $data_tahun = TahunService::getActive();
            $id_kelas = $this->getAccessibleKelas($request, $data_tahun);
            if ($id_kelas === false) return DataTables::of(collect([]))->make(true);

            $start_date = $request->input('start_date', date('Y-m-01'));
            $end_date = $request->input('end_date', date('Y-m-t'));
            
            $data = $this->rekapPelanggaranService->rekapRentangWaktu($id_kelas, $data_tahun->id, $start_date, $end_date);

            return DataTables::of($data)->addIndexColumn()->make(true);
        }
    }

    public function getRekapSemester(Request $request)
    {
        if ($request->ajax()) {
            $data_tahun = TahunService::getActive();
            $id_kelas = $this->getAccessibleKelas($request, $data_tahun);
            if ($id_kelas === false) return DataTables::of(collect([]))->make(true);

            $semester = $request->input('semester', $data_tahun->semester);
            $data = $this->rekapPelanggaranService->rekapSemester($id_kelas, $data_tahun->id, $semester);

            return DataTables::of($data)->addIndexColumn()->make(true);
        }
    }

    public function getRekapTahunan(Request $request)
    {
        if ($request->ajax()) {
            $data_tahun = TahunService::getActive();
            $id_kelas = $this->getAccessibleKelas($request, $data_tahun);
            if ($id_kelas === false) return DataTables::of(collect([]))->make(true);

            $data = $this->rekapPelanggaranService->rekapTahunan($id_kelas, $data_tahun->id);

            return DataTables::of($data)->addIndexColumn()->make(true);
        }
    }
}
