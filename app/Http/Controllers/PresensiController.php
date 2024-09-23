<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Presensi;
use App\Services\KelasService;
use App\Services\PresensiService;
use App\Services\TahunService;
use App\Services\WalikelasService;
use Illuminate\Support\Carbon;

class PresensiController extends Controller
{
    public function index()
    {
        $tahun = TahunService::getActive()->tahun;

        $list_kelas = KelasService::listKelasByTahun($tahun);

        return view('presensi.index', ['list_kelas' => $list_kelas, 'tanggal' => date("d/m/Y"), 'data_th_akademik' => app('tahunAkademik')]);
    }

    public  function ajaxkelastanggal(Request $request, PresensiService $presensi)
    {
        if ($request->ajax()) {
            $id_kelas = $request->input('id_kelas');
            $tgl = date("Y/m/d");

            $hasil = $presensi->get_siswa_tanggal_kelas($id_kelas, $tgl);

            return response()->json([
                'students' => $hasil,
            ]);
        }
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {

            $id_grouping = $request->input('id_grouping');
            $tgl = date("Y/m/d");
            $semester = 1;
            $my_data = array(
                'id_grouping'   =>  $id_grouping,
                'status'        => $request->input('status'),
                'keterangan'    => $request->input('keterangan'),
                'tanggal'       => $tgl,
                'semester'      => $semester
            );
            $post = Presensi::updateOrCreate(['id_grouping' => $id_grouping, 'tanggal' => $tgl], $my_data);
            return response()->json($my_data);
        }
    }

    public function ajaxdestroy(Request $request)
    {
        if ($request->ajax()) {
            $id_kehadiran = $request->input('id_kehadiran');
            Presensi::find($id_kehadiran)->delete();
            return response()->json(['message' => 'Data kehadiran berhasil dihapus']);
        }
    }

    public function list_all()
    {
        $data_tahun = TahunService::getActive();
        $tahun = $data_tahun->tahun;
        if (WalikelasService::isWalikelas(auth()->user()->id, $data_tahun->id)) {
            $id_kelas = WalikelasService::getIdKelas(auth()->user()->id, $data_tahun->id);
            $list_kelas = KelasService::listKelasById($id_kelas);
            // dd($list_kelas);
        } else {
            $list_kelas = KelasService::listKelasByTahun($tahun);
        }
        return view('presensi.list_presensi', ['list_kelas' => $list_kelas, 'data_tahun' => $data_tahun]);
    }

    public  function ajax_list_by(Request $request, PresensiService $presensi)
    {
        if ($request->ajax()) {
            $id_kelas = $request->input('id_kelas');
            $tahun = $request->input('tahun');
            $semester = $request->input('semester');
            $tgl = $request->input('tanggal');
            $nama = $request->input('nama');

            $result = $presensi->get_presensi_by($id_kelas, $tahun, $semester, $tgl, $nama);

            return response()->json([
                'students' => $result,
            ]);
        }
    }
}
