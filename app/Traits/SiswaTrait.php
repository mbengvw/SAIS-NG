<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait SiswaTrait
{

    /**
     * @param $tahun_akademik, $id_kelas
     * @return $list_siswa
     */
    public function list_siswa_by($tahun_akademik = null, $id_kelas = null, $nama = null)
    {
        $query = DB::table('tst_grouping AS grouping')
            ->select(
                'grouping.id_grouping',
                'grouping.id_siswa',
                'grouping.id_kelas',
                'grouping.tahun',
                'siswa.nis',
                'siswa.nama_lengkap',
                'siswa.jk',
                'siswa.angkatan',
                'siswa.jalur',
                'siswa.asal_sltp',
                'kelas.id_kelas',
                'kelas.nama_kelas'
            )
            ->join('mst_siswa AS siswa', 'grouping.id_siswa', '=', 'siswa.id_siswa')
            ->join('mst_kelas AS kelas', 'grouping.id_kelas', '=', 'kelas.id_kelas')
            ->orderBy('siswa.nama_lengkap', 'asc');
        if ($tahun_akademik!=null) {
            $query->where('grouping.tahun', '=', $tahun_akademik);
        }
        if ($id_kelas!=null) {
            $query->where('kelas.id_kelas', '=', $id_kelas);
        }
        if ($nama != "") {
            $query->where('siswa.nama_lengkap', 'LIKE', '%' . $nama . '%');
        }

        $result = $query->get();
        return $result;
    }
}
