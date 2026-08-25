<?php

namespace App\Http\Controllers;

use App\Services\KelasService;
use App\Services\RekapPresensiService;
use App\Services\TahunService;
use App\Services\WalikelasService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LaporanPresensiController extends Controller
{
    private RekapPresensiService  $rekapPresensiService;

    public function __construct(RekapPresensiService $rekapPresensiService)
    {
        $this->rekapPresensiService = $rekapPresensiService;
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

        return view('presensi.laporan_tab', ['list_kelas' => $list_kelas, 'data_tahun' => $data_tahun]);
    }

    public function getRekapPresensi(Request $request)
    {
        if ($request->ajax()) {
            $data_tahun = TahunService::getActive();
            $id_kelas = $request->input('id_kelas');
            $user = auth()->user();

            if (!$user->hasAnyRole(['admin', 'guru-piket'])) {
                if (WalikelasService::isWalikelas($user->id, $data_tahun->id)) {
                    $id_kelas = WalikelasService::getIdKelas($user->id, $data_tahun->id);
                } else {
                    return DataTables::of(collect([]))->addIndexColumn()->make(true);
                }
            }

            $req_tahun = $request->input('tahun', $data_tahun->tahun);
            $req_semester = $request->input('semester', $data_tahun->semester);

            $data = $this->rekapPresensiService->rekapByKelasTahunSemeseter($id_kelas, $req_tahun, $req_semester);

            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function listRekapRentangWaktu(Request $request)
    {
        if ($request->ajax()) {
            $data_tahun = TahunService::getActive();
            $id_kelas = $request->input('id_kelas');
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $user = auth()->user();

            if (!$user->hasAnyRole(['admin', 'guru-piket'])) {
                if (WalikelasService::isWalikelas($user->id, $data_tahun->id)) {
                    $id_kelas = WalikelasService::getIdKelas($user->id, $data_tahun->id);
                } else {
                    return DataTables::of(collect([]))->addIndexColumn()->make(true);
                }
            }

            $data = $this->rekapPresensiService->rekapByRentangWaktu($id_kelas, $data_tahun->tahun, $start_date, $end_date);
            return DataTables::of($data)->addIndexColumn()->make(true);
        }
    }

    public function listRekapTahunan(Request $request)
    {
        if ($request->ajax()) {
            $data_tahun = TahunService::getActive();
            $id_kelas = $request->input('id_kelas');
            $req_tahun = $request->input('tahun', $data_tahun->tahun);
            $user = auth()->user();

            if (!$user->hasAnyRole(['admin', 'guru-piket'])) {
                if (WalikelasService::isWalikelas($user->id, $data_tahun->id)) {
                    $id_kelas = WalikelasService::getIdKelas($user->id, $data_tahun->id);
                } else {
                    return DataTables::of(collect([]))->addIndexColumn()->make(true);
                }
            }

            $data = $this->rekapPresensiService->rekapByKelasTahun($id_kelas, $req_tahun);
            return DataTables::of($data)->addIndexColumn()->make(true);
        }
    }

    public function listRekapPresensiBulanan(Request $request)
    {
        if ($request->ajax()) {
            $data_tahun = TahunService::getActive();
            $id_kelas = $request->input('id_kelas');
            $user = auth()->user();

            if (!$user->hasAnyRole(['admin', 'guru-piket'])) {
                if (WalikelasService::isWalikelas($user->id, $data_tahun->id)) {
                    $id_kelas = WalikelasService::getIdKelas($user->id, $data_tahun->id);
                } else {
                    return DataTables::of(collect([]))->addIndexColumn()->make(true);
                }
            }

            $bulan = $request->input('bulan');
            $data = $this->rekapPresensiService->rekapByKelasTahunBulan($id_kelas, $data_tahun->tahun, $bulan);
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }


}
