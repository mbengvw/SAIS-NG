<?php

namespace App\Services;

use App\Models\Grouping;
use App\Models\Kelas;
use Illuminate\Support\Facades\DB;

class KelasService
{
    public function create(array $data_kelas)
    {
        $new_data = [
            'id_kelas' => $data_kelas['id_kelas'],
            'id_tahun' => $data_kelas['id_tahun'],
            'tahun' => $data_kelas['tahun'],
            'jurusan' => $data_kelas['jurusan'],
            'tingkat' => $data_kelas['tingkat'],
            'paralel' => $data_kelas['paralel'],
            'nama_kelas' => $data_kelas['nama_kelas']
        ];
        Kelas::updateOrCreate(['id_kelas' => $data_kelas['id_kelas']], $new_data);
        return response()->json(['message' => 'Kelas berhasil dibuat']);
    }

    public function destroy($id_kelas)
    {
        //cek apakah sudah ada transaksi grouping
        if (Grouping::where('id_kelas', $id_kelas)->count() < 1) {
            Kelas::find($id_kelas)->delete();
            return response()->json(['message' => 'Data kelas berhasil dihapus']);
        } else {
            return response()->json(['message' => 'Sudah ada transaksi pengkelasan']);
        }
    }

    public function show($id_kelas)
    {
        return (Kelas::where('id_kelas', '=', $id_kelas)->first());
    }

    public static function listKelas($id_tahun = null)
    {
        $query = Kelas::query();

        if ($id_tahun != null) {
            $query->where('id_tahun', '=', $id_tahun);
        }

        $data = $query->get('*');

        return $data;
    }

    public static function listKelasByTahun($tahun = null)
    {
        $query = Kelas::query();

        if ($tahun != null) {
            $query->where('tahun', '=', $tahun);
        }

        $data = $query->get('*');

        return $data;
    }

    public static function listKelasById($id_kelas)
    {
        return Kelas::where('id_kelas','=',$id_kelas)->get();
    }

    public static function listSiswaByKelasTahun($id_kelas,$tahun)
    {
        $res=DB::select('
        SELECT G.*,S.nama,S.nisn FROM
        (SELECT * FROM `tst_grouping` WHERE `id_kelas`=? AND `tahun`=?) AS G
        LEFT JOIN students AS S ON G.id_siswa=S.id
        ORDER BY S.nama
        ',[$id_kelas,$tahun]);
        
        return $res;
    }
}
