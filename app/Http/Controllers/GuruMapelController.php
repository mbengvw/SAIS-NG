<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TahunService;
use Illuminate\Support\Facades\Auth;
use App\Models\PenetapanGuruMapel;
use App\Models\PertemuanGuruMapel;
use App\Models\CatatanPembelajaran;
use App\Models\Grouping;
use Illuminate\Support\Facades\DB;

class GuruMapelController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            if (!Auth::user()->hasRole('guru-mapel')) {
                return redirect('/guess')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
            }

            $data_tahun = TahunService::getActive();
            $tahun = $data_tahun ? $data_tahun->alias_tahun : "Belum Tersedia";
            
            $kelas_diampu = [];
            if ($data_tahun) {
                $kelas_diampu = PenetapanGuruMapel::with(['kelas', 'mapel'])
                    ->where('id_guru', Auth::id())
                    ->where('id_tahun', $data_tahun->id)
                    ->get();
            }

            return view('gurumapel.index', [
                'nama' => Auth::user()->name, 
                'tahun' => $tahun,
                'data_tahun' => $data_tahun,
                'kelas_diampu' => $kelas_diampu
            ]);
        }

        return redirect('login')->with('success', 'you are not allowed to access');
    }

    public function showKelas($id_penetapan)
    {
        $data_tahun = TahunService::getActive();
        $penetapan = PenetapanGuruMapel::with(['kelas', 'mapel'])->findOrFail($id_penetapan);
        
        // Ensure the logged in user is the teacher for this class
        if ($penetapan->id_guru != Auth::id()) {
            return redirect()->route('gurumapel.index')->with('error', 'Akses ditolak.');
        }

        $siswa = Grouping::with('siswa')
            ->where('id_kelas', $penetapan->id_kelas)
            ->where('id_tahun', $data_tahun->id)
            ->get();

        return view('gurumapel.show_kelas', compact('penetapan', 'siswa', 'data_tahun'));
    }

    public function storeCatatan(Request $request, $id_penetapan)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'materi_pembelajaran' => 'required|string',
            'catatan' => 'array',
        ]);

        $penetapan = PenetapanGuruMapel::findOrFail($id_penetapan);
        if ($penetapan->id_guru != Auth::id()) {
            return redirect()->route('gurumapel.index')->with('error', 'Akses ditolak.');
        }

        DB::beginTransaction();
        try {
            $pertemuan = PertemuanGuruMapel::create([
                'id_penetapan' => $id_penetapan,
                'tanggal' => $request->tanggal,
                'materi_pembelajaran' => $request->materi_pembelajaran,
            ]);

            if ($request->has('catatan')) {
                foreach ($request->catatan as $id_siswa => $isi_catatan) {
                    if (!empty($isi_catatan)) {
                        CatatanPembelajaran::create([
                            'id_pertemuan' => $pertemuan->id,
                            'id_siswa' => $id_siswa,
                            'catatan' => $isi_catatan,
                        ]);
                    }
                }
            }
            DB::commit();
            return redirect()->route('gurumapel.show_kelas', $id_penetapan)->with('success', 'Catatan pembelajaran berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function riwayatKelas($id_penetapan)
    {
        $penetapan = PenetapanGuruMapel::with(['kelas', 'mapel'])->findOrFail($id_penetapan);
        if ($penetapan->id_guru != Auth::id()) {
            return redirect()->route('gurumapel.index')->with('error', 'Akses ditolak.');
        }

        $riwayat = PertemuanGuruMapel::where('id_penetapan', $id_penetapan)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('gurumapel.riwayat_kelas', compact('penetapan', 'riwayat'));
    }

    public function detailRiwayat($id_pertemuan)
    {
        $pertemuan = PertemuanGuruMapel::findOrFail($id_pertemuan);
        $penetapan = PenetapanGuruMapel::findOrFail($pertemuan->id_penetapan);
        
        if ($penetapan->id_guru != Auth::id()) {
            return response()->json(['error' => 'Akses ditolak.'], 403);
        }

        $catatan = CatatanPembelajaran::with('siswa')
            ->where('id_pertemuan', $id_pertemuan)
            ->get();

        return response()->json($catatan);
    }
}
