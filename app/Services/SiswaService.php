<?php

namespace App\Services;

use App\Models\Siswa;
use App\Models\Student;
use Exception;

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
}
