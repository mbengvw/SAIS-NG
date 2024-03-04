<?php

namespace App\Services;

use App\Models\Siswa;
use Exception;

class SiswaService
{
    public function showByNisn($nisn)
    {
        $siswa=Siswa::where('nisn','=',$nisn)->first();
        if(!$siswa){
            throw new Exception('Siswa tidak ditemukan');
        }
        return $siswa;
    }

    public function showByNis($nis)
    {
        $siswa = Siswa::where('nis', '=', $nis)->first();
        if (!$siswa) {
            throw new Exception('Siswa tidak ditemukan');
        }
        return $siswa;
    }
}
