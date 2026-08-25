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
    public function index(Request $request){
        if (Auth::check()) {
            $data_tahun = TahunService::getActive();
            $tahun = $data_tahun ? $data_tahun->alias_tahun:"Belum Tersedia";
            
            // Logika Status Absensi untuk Dashboard Piket
            $tanggal = $request->input('tanggal', date('Y-m-d'));
            $list_kelas = collect([]);
            
            if ($data_tahun) {
                $list_kelas = KelasService::listKelasByTahun($data_tahun->tahun);
                $logs = LogPresensiKelas::where('tanggal', $tanggal)->pluck('id_kelas')->toArray();

                foreach ($list_kelas as &$kelas) {
                    $kelas['sudah_diabsen'] = in_array($kelas['id_kelas'], $logs);
                }
            }

            return view('piket.index', [
                'nama' => Auth::user()->name, 
                'tahun' => $tahun,
                'list_kelas' => $list_kelas,
                'tanggal' => $tanggal,
                'data_tahun' => $data_tahun
            ]);
        }

        return redirect('login')->with('success', 'you are not allowed to access');
    }

    public function listStudents(Request $request){
        if ($request->ajax()) {
            $user = Auth::user();
            if ($user->hasAnyRole(['admin', 'guru-piket'])) {
                $data = Student::whereIn('status', ['A', 'Aktif'])->get();
            } else {
                $data_tahun = TahunService::getActive();
                if (\App\Services\WalikelasService::isWalikelas($user->id, $data_tahun->id)) {
                    $id_kelas = \App\Services\WalikelasService::getIdKelas($user->id, $data_tahun->id);
                    $data = \Illuminate\Support\Facades\DB::table('tst_grouping')
                        ->join('students', 'tst_grouping.id_siswa', '=', 'students.id')
                        ->where('tst_grouping.id_tahun', $data_tahun->id)
                        ->where('tst_grouping.id_kelas', $id_kelas)
                        ->whereIn('students.status', ['A', 'Aktif'])
                        ->select('students.*')
                        ->get();
                } else {
                    $data = collect([]);
                }
            }

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
