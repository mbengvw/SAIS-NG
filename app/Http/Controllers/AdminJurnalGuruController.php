<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TahunService;
use App\Models\PenetapanGuruMapel;
use App\Models\PertemuanGuruMapel;
use App\Models\CatatanPembelajaran;
use App\Models\Grouping;

class AdminJurnalGuruController extends Controller
{
    public function index(Request $request)
    {
        $data_tahun = TahunService::getActive();
        $tahun = $data_tahun ? $data_tahun->alias_tahun : "Belum Tersedia";
        
        $penetapan = [];
        if ($data_tahun) {
            $query = PenetapanGuruMapel::with(['kelas', 'mapel', 'guru'])->where('id_tahun', $data_tahun->id);
            
            // Optional filter by guru or kelas
            if ($request->has('guru') && $request->guru != '') {
                $query->whereHas('guru', function($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->guru . '%');
                });
            }
            if ($request->has('kelas') && $request->kelas != '') {
                $query->whereHas('kelas', function($q) use ($request) {
                    $q->where('nama_kelas', 'like', '%' . $request->kelas . '%');
                });
            }
            if ($request->has('mapel') && $request->mapel != '') {
                $query->whereHas('mapel', function($q) use ($request) {
                    $q->where('nama_mapel', 'like', '%' . $request->mapel . '%');
                });
            }
            
            $penetapan = $query->get();
        }

        return view('admin.jurnal.index', compact('penetapan', 'tahun', 'data_tahun'));
    }

    public function showRiwayat($id_penetapan)
    {
        $data_tahun = TahunService::getActive();
        $penetapan = PenetapanGuruMapel::with(['kelas', 'mapel', 'guru'])->findOrFail($id_penetapan);

        $riwayat = PertemuanGuruMapel::where('id_penetapan', $id_penetapan)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('admin.jurnal.riwayat', compact('penetapan', 'riwayat', 'data_tahun'));
    }

    public function showDetail($id_pertemuan)
    {
        $data_tahun = TahunService::getActive();
        $pertemuan = PertemuanGuruMapel::findOrFail($id_pertemuan);
        $penetapan = PenetapanGuruMapel::with(['kelas', 'mapel', 'guru'])->findOrFail($pertemuan->id_penetapan);

        $siswa = Grouping::with('siswa')
            ->where('id_kelas', $penetapan->id_kelas)
            ->where('id_tahun', $data_tahun->id)
            ->get()
            ->sortBy('siswa.nama');
            
        $catatan_lama = CatatanPembelajaran::where('id_pertemuan', $id_pertemuan)
            ->pluck('catatan', 'id_siswa')->toArray();
        $kehadiran_lama = CatatanPembelajaran::where('id_pertemuan', $id_pertemuan)
            ->pluck('status_kehadiran', 'id_siswa')->toArray();

        return view('admin.jurnal.detail', compact('pertemuan', 'penetapan', 'siswa', 'catatan_lama', 'kehadiran_lama', 'data_tahun'));
    }
}
