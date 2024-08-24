<?php

namespace App\Services;

use App\Models\Grouping;
use App\Models\Kelas;

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
}
