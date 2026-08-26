<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\IzinKeluarService;
use App\Services\IzinKeluarQueryService;
use App\Services\SiswaService;
use App\Services\TahunService;
use Illuminate\Support\Facades\Auth;

class IzinKeluarGuruController extends Controller
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
        $user_id = Auth::id();
        $date = date('Y-m-d');
        $riwayat_izin = $this->queryService->getListByGuruPemberiAndDate($user_id, $date);

        return view('izin_keluar.guru.index', compact('riwayat_izin'));
    }

    public function create()
    {
        return view('izin_keluar.guru.create');
    }

    public function searchSiswa(Request $request)
    {
        $keyword = $request->input('q');
        $data_tahun = TahunService::getActive();
        
        $siswa = \App\Models\Student::query()
            ->join('tst_grouping', 'students.id', '=', 'tst_grouping.id_siswa')
            ->join('mst_kelas', 'tst_grouping.id_kelas', '=', 'mst_kelas.id_kelas')
            ->where('tst_grouping.id_tahun', $data_tahun->id)
            ->where('students.nama', 'like', "%{$keyword}%")
            ->select('students.id', 'students.nama', 'mst_kelas.nama_kelas', 'mst_kelas.id_kelas')
            ->limit(10)
            ->get();

        $formatted = $siswa->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->nama . ' (' . $item->nama_kelas . ')',
                'id_kelas' => $item->id_kelas
            ];
        });

        return response()->json(['results' => $formatted]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required',
            'id_kelas' => 'required',
            'alasan' => 'required|string|max:255',
        ]);

        $data = [
            'id_siswa' => $request->id_siswa,
            'id_kelas' => $request->id_kelas,
            'alasan' => $request->alasan,
            'id_guru_pemberi' => Auth::id(),
            'is_pulang' => $request->has('is_pulang')
        ];

        $this->izinService->ajukanIzin($data);

        return redirect()->route('guru.izin_keluar.index')->with('success', 'Pengajuan izin berhasil dibuat. Siswa dapat melapor ke Piket.');
    }
}
