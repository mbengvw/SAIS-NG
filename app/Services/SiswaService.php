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

    public static function detail($id_siswa,$tahun)
    {
        $res = DB::select('
        SELECT SG.*,K.nama_kelas FROM
            (SELECT S.*,G.id_grouping,G.id_siswa,G.id_kelas,G.id_tahun,G.tahun FROM
                (SELECT * FROM `students` WHERE `id`=?) AS S
        LEFT JOIN 
            (SELECT * FROM tst_grouping WHERE tst_grouping.tahun= ?) AS G ON S.id=G.id_siswa) AS SG
        JOIN mst_kelas AS K ON K.id_kelas = SG.id_kelas
        ',[$id_siswa,$tahun]);

        return $res;
    }

}
