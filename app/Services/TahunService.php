<?php

namespace App\Services;

use App\Models\Tahun;
use Illuminate\Support\Facades\DB;

class TahunService
{
    public static function addNew()
    {
        $new_rec = array();
        $last = Tahun::orderBy('id', 'desc')->first();

        if (!$last) {
            $new_rec['tahun'] = date('Y');
            $new_rec['semester'] = 1;
            $new_rec['alias_tahun'] = date('Y') . "1";
            $new_rec['is_active'] = 0;
            return $new_rec;
        }

        if ($last->semester == 1) {
            $new_rec['tahun'] = $last->tahun;
            $new_rec['semester'] = 2;
            $new_rec['alias_tahun'] = $last->tahun . "2";
            $new_rec['is_active'] = 0;
        } else {
            $new_rec['tahun'] = $last->tahun + 1;
            $new_rec['semester'] = 1;
            $new_rec['alias_tahun'] = ($last->tahun + 1) . "1";
            $new_rec['is_active'] = 0;
        }
        return $new_rec;
    }

    public static function setActive($id)
    {
        DB::transaction(function () use ($id) {
            // set 0 field is_active untuk semua record
            Tahun::query()->update(['is_active' => 0]);
            // set 1 untuk id yg diinginkan
            Tahun::where('id', '=', $id)->update(['is_active' => 1]);
        });
        return true;
    }

    public static function getActive()
    {
        $tahun = Tahun::where('is_active', '=', '1')->first();
        return $tahun;
    }
}
