<?php

namespace App\Services;

use App\Models\Walikelas;
use Exception;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class SetWalikelasService
{
    public function listWalikelas($tahun)
    {
        $query = Walikelas::join('users', 'walikelas.id_user', '=', 'users.id')
            ->join('mst_kelas', 'walikelas.id_kelas', '=', 'mst_kelas.id_kelas');
        return $query->get(['walikelas.*', 'users.name', 'users.email', 'mst_kelas.tingkat', 'mst_kelas.nama_kelas']);
    }

    public function create(array $data_walas)
    {
        $new_data = [
            'id_walas' => $data_walas['id_walas'],
            'id_tahun' => $data_walas['id_tahun'],
            'tahun' => $data_walas['tahun'],
            'id_kelas' => $data_walas['id_kelas'],
            'id_user' => $data_walas['id_user'],
        ];
        Walikelas::updateOrCreate(['id_kelas' => $data_walas['id_walas']], $new_data);
        return response()->json(['message' => 'Data berhasil disimpan']);
    }

    public function destroy($id_walas)
    {
        try{
            Walikelas::find($id_walas)->delete();
            return response()->json(['message' => 'Data penetapan berhasil dihapus']);
        }catch(Exception $e){
            return response()->json(['message' => $e->getMessage()]);
        }

    }
}
