<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\TrxMbg;
use App\Models\LogPresensiKelas;
use App\Models\Presensi;
use App\Services\TahunService;
use App\Services\KelasService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MbgController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->input('tanggal', date('Y-m-d'));
        $data_tahun = TahunService::getActive();
        
        if (!$data_tahun) {
            return redirect('/')->with('error', 'Tahun Akademik aktif tidak ditemukan.');
        }

        $tahun = $data_tahun->tahun;
        $semester = $data_tahun->semester;

        // Ambil semua kelas
        $list_kelas = KelasService::listKelasByTahun($tahun);
        $kelasIds = collect($list_kelas)->pluck('id_kelas')->toArray();

        // Ambil trx mbg untuk tanggal ini
        $trxMbgs = TrxMbg::where('tanggal', $tanggal)->get()->keyBy('id_kelas');

        // Ambil data log presensi kelas
        $logs = LogPresensiKelas::where('tanggal', $tanggal)->get()->keyBy('id_kelas');

        // Ambil rekap absen hari ini (S, I, A) untuk menghitung target tray.
        // Asumsi: Kita cari siswa yang hadir (total siswa aktif di kelas - yang absen/sakit/izin)
        $presensiData = DB::table('tst_kehadiran')
            ->join('tst_grouping', 'tst_kehadiran.id_grouping', '=', 'tst_grouping.id_grouping')
            ->where('tst_kehadiran.tanggal', $tanggal)
            ->where('tst_kehadiran.semester', $semester)
            ->select('tst_grouping.id_kelas', DB::raw('count(*) as tidak_hadir'))
            ->groupBy('tst_grouping.id_kelas')
            ->get()
            ->keyBy('id_kelas');

        $totalSiswaPerKelas = DB::table('tst_grouping')
            ->join('students', 'tst_grouping.id_siswa', '=', 'students.id')
            ->where('tst_grouping.id_tahun', $data_tahun->id)
            ->whereIn('students.status', ['A', 'Aktif'])
            ->select('tst_grouping.id_kelas', DB::raw('count(*) as total'))
            ->groupBy('tst_grouping.id_kelas')
            ->get()
            ->keyBy('id_kelas');

        foreach ($list_kelas as &$kelas) {
            $id = $kelas['id_kelas'];
            $trx = $trxMbgs->get($id);
            $log = $logs->get($id);

            $totalSiswa = $totalSiswaPerKelas->has($id) ? $totalSiswaPerKelas->get($id)->total : 0;
            $tidakHadir = $presensiData->has($id) ? $presensiData->get($id)->tidak_hadir : 0;
            $targetHadir = $totalSiswa - $tidakHadir;

            $kelas['total_siswa'] = $totalSiswa;
            $kelas['target_hadir'] = $targetHadir;
            $kelas['sudah_absen'] = $log !== null;
            
            if ($trx) {
                $kelas['status_mbg'] = $trx->status;
                $kelas['trx'] = $trx;
            } else {
                $kelas['status_mbg'] = 'belum';
                $kelas['trx'] = null;
            }
        }

        $is_admin = auth()->user()->hasAnyRole(['admin']);

        return view('mbg.index', [
            'list_kelas' => $list_kelas,
            'tanggal' => $tanggal,
            'data_tahun' => $data_tahun,
            'is_admin' => $is_admin
        ]);
    }

    public function getKelasData(Request $request, $id_kelas)
    {
        $tanggal = $request->input('tanggal', date('Y-m-d'));
        $data_tahun = TahunService::getActive();
        $semester = $data_tahun->semester;

        $totalSiswa = DB::table('tst_grouping')
            ->join('students', 'tst_grouping.id_siswa', '=', 'students.id')
            ->where('tst_grouping.id_tahun', $data_tahun->id)
            ->where('tst_grouping.id_kelas', $id_kelas)
            ->whereIn('students.status', ['A', 'Aktif'])
            ->count();

        $tidakHadir = DB::table('tst_kehadiran')
            ->join('tst_grouping', 'tst_kehadiran.id_grouping', '=', 'tst_grouping.id_grouping')
            ->where('tst_kehadiran.tanggal', $tanggal)
            ->where('tst_kehadiran.semester', $semester)
            ->where('tst_grouping.id_kelas', $id_kelas)
            ->count();

        $targetHadir = $totalSiswa - $tidakHadir;
        
        $trx = TrxMbg::where('id_kelas', $id_kelas)->where('tanggal', $tanggal)->first();

        return response()->json([
            'total_siswa' => $totalSiswa,
            'target_hadir' => $targetHadir,
            'trx' => $trx
        ]);
    }

    public function checkout(Request $request)
    {
        $id_kelas = $request->input('id_kelas');
        $tanggal = $request->input('tanggal');
        
        $trx = TrxMbg::firstOrNew(['id_kelas' => $id_kelas, 'tanggal' => $tanggal]);
        
        $trx->jumlah_hadir = $request->input('jumlah_hadir');
        $trx->jumlah_diambil = $request->input('jumlah_diambil');
        $trx->nama_pengambil = $request->input('nama_pengambil');
        $trx->waktu_diambil = now();
        $trx->status = 'diambil';
        $trx->id_user_piket = Auth::id();
        $trx->save();

        return response()->json(['success' => true, 'message' => 'Tray berhasil dicatat sebagai diambil.']);
    }

    public function checkin(Request $request)
    {
        $id_kelas = $request->input('id_kelas');
        $tanggal = $request->input('tanggal');
        
        $trx = TrxMbg::where(['id_kelas' => $id_kelas, 'tanggal' => $tanggal])->first();
        if (!$trx) {
            return response()->json(['success' => false, 'message' => 'Data pengambilan tidak ditemukan.']);
        }

        $kembali_sekarang = (int) $request->input('jumlah_kembali');
        $sudah_kembali = (int) $trx->jumlah_kembali;
        $sisa = $trx->jumlah_diambil - $sudah_kembali;

        if ($kembali_sekarang > $sisa) {
            return response()->json(['success' => false, 'message' => "Jumlah pengembalian ($kembali_sekarang) tidak boleh melebihi sisa tray yang dipinjam ($sisa)."]);
        }

        $trx->jumlah_kembali = $sudah_kembali + $kembali_sekarang;
        $trx->waktu_kembali = now();
        $trx->id_user_piket = Auth::id();

        $is_selesai_paksa = $request->input('is_selesai') == '1';

        if ($trx->jumlah_kembali == $trx->jumlah_diambil || $is_selesai_paksa) {
            $trx->status = 'selesai';
            if ($trx->jumlah_kembali < $trx->jumlah_diambil) {
                $trx->keterangan = $trx->keterangan ? $trx->keterangan . " | " . $request->input('keterangan') : $request->input('keterangan');
            }
        }

        $trx->save();

        return response()->json(['success' => true, 'message' => 'Tray berhasil dicatat sebagai dikembalikan.']);
    }

    public function rekap(Request $request)
    {
        $data_tahun = TahunService::getActive();
        $list_kelas = KelasService::listKelasByTahun($data_tahun->tahun);
        
        return view('mbg.rekap', [
            'list_kelas' => $list_kelas,
            'data_tahun' => $data_tahun
        ]);
    }

    public function getRekap(Request $request)
    {
        if ($request->ajax()) {
            $query = TrxMbg::query()
                ->join('mst_kelas', 'trx_mbg.id_kelas', '=', 'mst_kelas.id_kelas')
                ->select([
                    'trx_mbg.id',
                    'trx_mbg.tanggal',
                    'mst_kelas.nama_kelas',
                    'trx_mbg.jumlah_hadir',
                    'trx_mbg.jumlah_diambil',
                    'trx_mbg.jumlah_kembali',
                    'trx_mbg.status',
                    'trx_mbg.keterangan',
                    'trx_mbg.nama_pengambil'
                ]);

            if ($request->filled('start_date') && $request->filled('end_date')) {
                $query->whereBetween('trx_mbg.tanggal', [$request->start_date, $request->end_date]);
            } else {
                $query->where('trx_mbg.tanggal', date('Y-m-d'));
            }

            if ($request->filled('id_kelas')) {
                $query->where('trx_mbg.id_kelas', $request->id_kelas);
            }

            return \Yajra\DataTables\Facades\DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('selisih', function ($row) {
                    return $row->jumlah_diambil - $row->jumlah_kembali;
                })
                ->editColumn('status', function ($row) {
                    if ($row->status == 'selesai') {
                        return '<span class="badge badge-success">Selesai</span>';
                    } elseif ($row->status == 'diambil') {
                        return '<span class="badge badge-warning">Dipinjam</span>';
                    }
                    return '<span class="badge badge-secondary">Belum</span>';
                })
                ->rawColumns(['status'])
                ->make(true);
        }
    }
}
