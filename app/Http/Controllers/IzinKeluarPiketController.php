<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\IzinKeluarService;
use App\Services\IzinKeluarQueryService;
use App\Models\TrxIzinKeluar;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class IzinKeluarPiketController extends Controller
{
    protected $izinService;
    protected $queryService;

    public function __construct(IzinKeluarService $izinService, IzinKeluarQueryService $queryService)
    {
        $this->izinService = $izinService;
        $this->queryService = $queryService;
    }

    public function index()
    {
        $date = date('Y-m-d');
        
        $menunggu = $this->queryService->getListByStatusAndDate('menunggu', $date);
        $keluar = $this->queryService->getListByStatusAndDate('keluar', $date);
        
        // Count limits for badges
        $count_menunggu = $menunggu->count();
        $count_keluar = $keluar->count();

        return view('izin_keluar.piket.index', compact('menunggu', 'keluar', 'count_menunggu', 'count_keluar'));
    }

    public function approve($id)
    {
        $this->izinService->approveKeluar($id, Auth::id());
        return response()->json(['success' => true, 'message' => 'Izin berhasil disetujui. Siswa telah keluar.']);
    }

    public function kembali($id)
    {
        $this->izinService->laporKembali($id, Auth::id());
        return response()->json(['success' => true, 'message' => 'Siswa berhasil dilaporkan kembali ke sekolah.']);
    }

    public function cetakSurat($id)
    {
        $izin = TrxIzinKeluar::with(['siswa', 'kelas', 'guruPemberi'])->findOrFail($id);
        
        // Menggunakan view khusus cetak
        return view('izin_keluar.piket.cetak', compact('izin'));
    }

    public function rekap(Request $request)
    {
        $data_tahun = \App\Services\TahunService::getActive();
        $list_kelas = \App\Services\KelasService::listKelasByTahun($data_tahun->tahun);
        
        return view('izin_keluar.piket.rekap', [
            'list_kelas' => $list_kelas,
            'data_tahun' => $data_tahun
        ]);
    }

    public function getRekap(Request $request)
    {
        if ($request->ajax()) {
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $id_kelas = $request->input('id_kelas');

            $query = $this->queryService->getRekapQuery($start_date, $end_date, $id_kelas);

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if ($row->status == 'kembali') {
                        return '<span class="badge badge-success">Selesai/Kembali</span>';
                    } elseif ($row->status == 'keluar') {
                        return '<span class="badge badge-warning">Sedang di Luar</span>';
                    }
                    return '<span class="badge badge-secondary">Menunggu</span>';
                })
                ->addColumn('waktu_keluar_formatted', function ($row) {
                    return $row->waktu_keluar ? date('H:i', strtotime($row->waktu_keluar)) : '-';
                })
                ->addColumn('waktu_kembali_formatted', function ($row) {
                    if ($row->is_pulang && !$row->waktu_kembali) {
                        return '<span class="text-danger">Izin Pulang</span>';
                    }
                    return $row->waktu_kembali ? date('H:i', strtotime($row->waktu_kembali)) : '-';
                })
                ->rawColumns(['status', 'waktu_kembali_formatted'])
                ->make(true);
        }
    }
}
