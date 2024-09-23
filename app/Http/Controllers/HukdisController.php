<?php

namespace App\Http\Controllers;

use App\Http\Requests\HukdisRequest;
use Illuminate\Http\Request;
use App\Models\Hukdis;
use App\Models\Kelas;
use App\Models\Pelanggaran;
use App\Traits\SiswaTrait;
use App\Services\HukdisService;
use Illuminate\Support\Facades\Auth;

class HukdisController extends Controller
{
    use SiswaTrait;

    public function index()
    {
        $data_ta = app('tahunAkademik');
        $list_kelas = Kelas::all();
        $list_hukdis = Hukdis::all();
        return view('hukdis.index', [
            'list_kelas' => $list_kelas,
            'tanggal' => date("d/m/Y"),
            'list_hukdis' => $list_hukdis,
            'data_th_akademik' => $data_ta
        ]);
    }

    public function list_by(HukdisService $hukdis)
    {
        $data = $hukdis->get_hukdis_by();
        dd($data);
    }

    public  function ajax_list_by(Request $request, HukdisService $hukdis)
    {
        if ($request->ajax()) {
            $id_kelas = $request->input('id_kelas');
            $tahun = $request->input('tahun');
            $semester = $request->input('semester');
            $tgl = $request->input('tanggal');
            $nama = $request->input('nama');

            $data = $hukdis->get_hukdis_by($id_kelas, $tahun, $semester, $tgl, $nama);

            return response()->json($data);
        }
    }

    public function list_siswa_by_tahun($tahun)
    {
        $list_siswa = $this->list_siswa_by($tahun);
        dd($list_siswa);
    }

    public function ajax_list_siswa_by_tahun(Request $request)
    {
        if ($request->ajax()) {
            $tahun = $request->input('tahun');
            $id_kelas = $request->input('id_kelas');
            $result = $this->list_siswa_by($tahun, $id_kelas, null);
            return response()->json([
                'students' => $result,
            ]);
        }
    }

    public function ajaxStore(HukdisRequest $request)
    {
        $form_data = array(
            'id_hukdis'  =>  $request->id_hukdis,
            'id_grouping'     =>  $request->id_grouping,
            'tanggal'        =>  date("Y/m/d"),
            'semester'        =>  $request->semester,
            'id_petugas'       =>  Auth::user()->id,
        );
        $post = Pelanggaran::updateOrCreate($form_data);
        return response()->json($post);
    }

    public function ajaxdestroy(Request $request)
    {
        $id_pelanggaran = $request->input('id_pelanggaran');
        Pelanggaran::find($id_pelanggaran)->delete();
        return response()->json(['success' => 'Pelanggaran suskses dihapus.']);
    }
}
