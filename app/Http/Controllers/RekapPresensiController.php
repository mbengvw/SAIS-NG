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

        $user = auth()->user();

        if ($user->hasAnyRole(['admin', 'guru-piket'])) {
            $list_kelas = KelasService::listKelasByTahun($data_tahun->tahun);
        } else if (\App\Services\WalikelasService::isWalikelas($user->id, $data_tahun->id)) {
            $id_kelas = \App\Services\WalikelasService::getIdKelas($user->id, $data_tahun->id);
            $list_kelas = KelasService::listKelasById($id_kelas);
        } else {
            $list_kelas = collect([]);
        }

        return view('presensi.rekap_bulanan', ['list_kelas' => $list_kelas, 'tanggal' => date("d/m/Y"), 'data_tahun' => app('tahunAkademik')]);
    }
}
