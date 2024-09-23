<?php

namespace App\Http\Controllers;

use App\Services\KelasService;
use App\Services\TahunService;
use Illuminate\Http\Request;

class RekapPresensiController extends Controller
{
    public function index()
    {
        $data_tahun = TahunService::getActive();

        $list_kelas = KelasService::listKelasByTahun($data_tahun->tahun);

        return view('presensi.rekap_bulanan', ['list_kelas' => $list_kelas, 'tanggal' => date("d/m/Y"), 'data_tahun' => app('tahunAkademik')]);
    }
}
