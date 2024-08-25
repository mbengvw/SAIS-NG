<?php

namespace App\Services;

use App\Models\User;
use App\Models\Walikelas;

class WalikelasService
{
    public static function isWalikelas($id_user,$id_tahun){
        return Walikelas::where('id_user','=',$id_user)->where('id_tahun','=',$id_tahun)->exists();
    }

    public static function getIdKelas($id_user,$id_tahun)
    {
        $walikelas = Walikelas::where('id_user', '=', $id_user)->where('id_tahun', '=', $id_tahun)->first();
        if($walikelas){
            return $walikelas->id_kelas;
        }else{
            return null;
        }
    }
}
