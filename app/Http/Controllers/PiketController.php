<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\TahunService;
use Yajra\DataTables\Facades\DataTables;
use App\Services\KelasService;
use App\Models\LogPresensiKelas;

class PiketController extends Controller
{
    public function index(){
        if (Auth::check()) {
            $data_tahun = TahunService::getActive();
            $tahun = $data_tahun ? $data_tahun->alias_tahun:"Belum Tersedia";
            return view('piket.index', ['nama' => Auth::user()->name, 'tahun' => $tahun]);
        }

        return redirect('login')->with('success', 'you are not allowed to access');
    }

    public function listStudents(Request $request){
        if ($request->ajax()) {
            $data = Student::where('status','=','A')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $button = '<button type="button" name="show" id="' . $row->id . '" class="show-detail btn btn-primary btn-sm">Detail</button>';
                    return $button;
                })
                ->make(true);
        }

        return view('piket.siswa');
    }

    public function statusAbsensi(Request $request){
        $tanggal = $request->input('tanggal', date('Y-m-d'));
        $data_tahun = TahunService::getActive();
        $tahun = $data_tahun->tahun;

        // Ambil semua kelas
        $list_kelas = KelasService::listKelasByTahun($tahun);
        
        // Ambil data log presensi untuk tanggal ini
        $logs = LogPresensiKelas::where('tanggal', $tanggal)->pluck('id_kelas')->toArray();

        foreach ($list_kelas as &$kelas) {
            $kelas['sudah_diabsen'] = in_array($kelas['id_kelas'], $logs);
        }

        return view('piket.status_absensi', [
            'list_kelas' => $list_kelas,
            'tanggal' => $tanggal,
            'data_tahun' => $data_tahun
        ]);
    }
}
