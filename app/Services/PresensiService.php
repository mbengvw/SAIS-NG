<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Presensi;
use Carbon\Carbon;

class PresensiService
{


    public  function get_siswa_tanggal_kelas($id_kelas, $tgl)
    {
        /**
         * Fungsi untuk menampilkan daftar siswa di daftar absen
         */
        $data_peresensi = DB::table('tst_kehadiran')
            ->select('*')
            ->where('tanggal', $tgl);

        $result = DB::table('tst_grouping')->select(
            'tst_grouping.id_grouping',
            'data_presensi.id_kehadiran',
            'data_presensi.semester',
            'data_presensi.tanggal',
            'data_presensi.status',
            'data_presensi.keterangan',
            'mst_siswa.nis',
            'mst_siswa.nama_lengkap',
            'mst_siswa.jk',
            'mst_kelas.nama_kelas'
        )
            ->leftJoinSub($data_peresensi, 'data_presensi', function ($join) {
                $join->on('tst_grouping.id_grouping', '=', 'data_presensi.id_grouping');
            })
            ->join('mst_siswa', 'tst_grouping.id_siswa', '=', 'mst_siswa.id_siswa')
            ->join('mst_kelas', 'tst_grouping.id_kelas', '=', 'mst_kelas.id_kelas')
            ->orderBy('mst_siswa.nama_lengkap', 'asc')
            ->where('tst_grouping.id_kelas', $id_kelas)
            ->get();
        return $result;
    }


    public function get_presensi_by($id_kelas = null, $tahun = null, $semester = null, $tgl = null, $nama = null)
    {
        $query = DB::table('tst_kehadiran AS kehadiran')
            ->select(
                'kehadiran.id_kehadiran',
                'kehadiran.id_grouping',
                'kehadiran.semester',
                'kehadiran.tanggal',
                'kehadiran.status',
                'grouping.id_siswa',
                'grouping.id_kelas',
                'grouping.id_tahun',
                'tahun.tahun',
                'tahun.semester',
                'tahun.alias_tahun',
                'siswa.nis',
                'siswa.nama_lengkap',
                'siswa.jk',
                'siswa.angkatan',
                'siswa.jalur',
                'siswa.asal_sltp',
                'kelas.id_kelas',
                'kelas.nama_kelas'
            )
            ->join('tst_grouping AS grouping', 'kehadiran.id_grouping', '=', 'grouping.id_grouping')
            ->join('mst_tahun AS tahun', 'grouping.id_tahun', '=', 'tahun.id')
            ->join('mst_siswa AS siswa', 'grouping.id_siswa', '=', 'siswa.id_siswa')
            ->join('mst_kelas AS kelas', 'grouping.id_kelas', '=', 'kelas.id_kelas')
            ->orderBy('siswa.nama_lengkap', 'asc');
        if ($id_kelas) {
            $query->where('kelas.id_kelas', '=', $id_kelas);
        }
        if ($tahun) {
            $query->where('tahun.tahun', '=', $tahun);
        }
        if ($semester) {
            $query->where('tahun.semester', '=', $semester);
        }
        if ($tgl) {
            $newDate = Carbon::createFromFormat('m/d/Y', $tgl)->format('Y-m-d');
            $query->where('kehadiran.tanggal', '=', $newDate);
        }
        if ($nama != "") {
            $query->where('siswa.nama_lengkap', 'LIKE', '%' . $nama . '%');
        }
        $result = $query->get();
        return $result;
    }
}
