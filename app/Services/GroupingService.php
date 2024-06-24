<?php

namespace App\Services;

use App\Models\Grouping;
use App\Models\Presensi;
use Ramsey\Uuid\Type\Integer;

class GroupingService
{
    public function listGrouping($id_kelas = null, $id_tahun = null)
    {
        $query = Grouping::join('mst_siswa', 'tst_grouping.id_siswa', '=', 'mst_siswa.id_siswa')
            ->join('mst_kelas', 'tst_grouping.id_kelas', '=', 'mst_kelas.id_kelas')
            ->orderBy('mst_siswa.nama_lengkap', 'asc');

        if ($id_kelas != null) {
            $query->where('tst_grouping.id_kelas', '=', $id_kelas);
        }
        if ($id_tahun != null) {
            $query->where('tst_grouping.id_tahun', '=', $id_tahun);
        }

        $data = $query->get(['tst_grouping.*', 'mst_siswa.*', 'mst_kelas.*']);

        return $data;
    }

    public function listGroupingByTahun($id_kelas = null, $tahun = null)
    {
        $query = Grouping::join('students', 'tst_grouping.id_siswa', '=', 'students.id')
        ->join('mst_kelas', 'tst_grouping.id_kelas', '=', 'mst_kelas.id_kelas')
        ->orderBy('students.nama', 'asc');

        if ($id_kelas != null) {
            $query->where('tst_grouping.id_kelas', '=', $id_kelas);
        }
        if ($tahun != null) {
            $query->where('tst_grouping.tahun', '=', $tahun);
        }

        $data = $query->get(['tst_grouping.*', 'students.*', 'mst_kelas.*']);

        return $data;
    }

    public function doGrouping(array $list_id_siswa, $id_kelas, $id_tahun,$tahun)
    {
        foreach ($list_id_siswa as $id_siswa) {
            $data = array(
                'id_siswa' => $id_siswa,
                'id_kelas' => $id_kelas,
                'id_tahun' => $id_tahun,
                'tahun'=>$tahun,
            );
            Grouping::insert($data);
        }
    }

    public function destroy($id_grouping)
    {
        //cek apakah sudah ada transaksi kerhadiran
        if (Presensi::where('id_grouping', $id_grouping)->count() < 1) {
            Grouping::find($id_grouping)->delete();
            return response()->json(['message' => 'Data grouping berhasil dihapus']);
        } else {
            return response()->json(['message' => 'Sudah ada transaksi kehadiran']);
        }
    }
}
