<?php

namespace App\Services;

use App\Models\Siswa;
use App\Models\Student;
use Exception;
use Illuminate\Support\Facades\DB;

class SiswaService
{
    public function showByNisn($nisn)
    {
        $siswa=Student::where('nisn','=',$nisn)->first();
        if(!$siswa){
            throw new Exception('Siswa tidak ditemukan');
        }
        return $siswa;
    }

    public function showByNis($nis)
    {
        $siswa = Student::where('nis', '=', $nis)->first();
        if (!$siswa) {
            throw new Exception('Siswa tidak ditemukan');
        }
        return $siswa;
    }

    public static function detail($id_siswa, $tahun)
    {
        $res = DB::select('
            SELECT s.*, k.nama_kelas 
            FROM students s
            LEFT JOIN tst_grouping g ON s.id = g.id_siswa AND g.tahun = ?
            LEFT JOIN mst_kelas k ON g.id_kelas = k.id_kelas
            WHERE s.id = ?
        ', [$tahun, $id_siswa]);

        // Berikan fallback string jika siswa belum masuk kelas
        if (!empty($res) && is_null($res[0]->nama_kelas)) {
            $res[0]->nama_kelas = "Belum Masuk Kelas";
        }

        return $res;
    }

    public  function listByAngkatan($tahun)
    {
        return Student::where('tahun_masuk','=',$tahun)->get();
    }

}
