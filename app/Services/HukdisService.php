<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class HukdisService
{
    public  function get_hukdis_by($id_kelas = null, $tahun = null, $semester = null, $tgl = null, $nama = null)
    {

        $query = DB::table('tst_pelanggaran AS pelanggaran')
            ->select(
                'pelanggaran.id_pelanggaran',
                'pelanggaran.id_hukdis',
                'pelanggaran.id_grouping',
                'pelanggaran.semester',
                'pelanggaran.tanggal',
                'pelanggaran.id_petugas',
                'grouping.id_siswa',
                'grouping.id_kelas',
                'grouping.tahun',
                'hukdis.deskripsi',
                'hukdis.poin',
                'siswa.nis',
                'siswa.nisn',
                'siswa.nama_lengkap',
                'siswa.jk',
                'siswa.angkatan',
                'siswa.jalur',
                'siswa.asal_sltp',
                'kelas.id_kelas',
                'kelas.nama_kelas'
            )
            ->join('mst_hukdis AS hukdis', 'hukdis.id_hukdis', '=', 'pelanggaran.id_hukdis')
            ->join('tst_grouping AS grouping', 'pelanggaran.id_grouping', '=', 'grouping.id_grouping')
            ->join('mst_siswa AS siswa', 'grouping.id_siswa', '=', 'siswa.id_siswa')
            ->join('mst_kelas AS kelas', 'grouping.id_kelas', '=', 'kelas.id_kelas')
            ->orderBy('siswa.nama_lengkap', 'asc');
        if ($id_kelas) {
            $query->where('kelas.id_kelas', '=', $id_kelas);
        }
        if ($tahun) {
            $query->where('grouping.tahun', '=', $tahun);
        }
        if ($semester) {
            $query->where('pelanggaran.semester', '=', $semester);
        }
        if ($tgl) {
            $query->where('pelanggaran.tanggal', '=', $tgl);
        }
        if ($nama != "") {
            $query->where('siswa.nama_lengkap', 'LIKE', '%' . $nama . '%');
        }
        $result = $query->get();

        return $result;

        // return response()->json($result);
    }
}
