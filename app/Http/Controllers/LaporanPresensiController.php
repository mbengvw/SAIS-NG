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
        if (WalikelasService::isWalikelas(auth()->user()->id, $data_tahun->id)) {
            $id_kelas = WalikelasService::getIdKelas(auth()->user()->id, $data_tahun->id);
            $list_kelas = KelasService::listKelasById($id_kelas);
        } else {
            $list_kelas = KelasService::listKelasByTahun($tahun);
        }

        return view('presensi.rekap_presensi', ['list_kelas' => $list_kelas, 'data_tahun' => $data_tahun]);
    }

    public function getRekapPresensi(Request $request)
    {
        if ($request->ajax()) {
            $data_tahun = TahunService::getActive();
            $id_kelas = $request->input('id_kelas');
            // $id_kelas = WalikelasService::getIdKelas(auth()->user()->id, $data_tahun->id);
            $data = $this->rekapPresensiService->rekapByKelasTahunSemeseter($id_kelas, $data_tahun->tahun, $data_tahun->semester);

            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function listRekapPresensiBulanan(Request $request)
    {
        if ($request->ajax()) {
            $data_tahun = TahunService::getActive();
            $id_kelas = $request->input('id_kelas');
            $bulan = $request->input('bulan');
            $data = $this->rekapPresensiService->rekapByKelasTahunBulan($id_kelas, $data_tahun->tahun, $bulan);
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }


}
