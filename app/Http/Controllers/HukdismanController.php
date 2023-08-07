<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Hukdis;
use App\Services\HukdisService;
use Yajra\DataTables\DataTables;

class HukdismanController extends Controller
{
    public function index()
    {
        $data_tahun = app('tahunAkademik');
        $list_kelas = Kelas::all();
        $list_hukdis = Hukdis::all();
        return view('hukdis.list_hukdis', ['list_kelas' => $list_kelas, 'data_tahun' => $data_tahun, 'list_hukdis' => $list_hukdis]);
    }

    public  function list_by(Request $request, HukdisService $hukdis)
    {
        if ($request->ajax()) {
            $id_kelas = $request->input('id_kelas');
            $tahun = $request->input('tahun');
            $semester = $request->input('semester');
            $tgl = $request->input('tanggal');
            $nama = $request->input('nama');

            $data = $hukdis->get_hukdis_by($id_kelas, $tahun, $semester, $tgl, $nama);
            return $data;
        }
    }
}
