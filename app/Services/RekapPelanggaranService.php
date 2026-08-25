<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class RekapPelanggaranService
{
    private function baseQuery($id_kelas, $tahun, $filter = [])
    {
        $query = DB::table('tst_grouping AS grouping')
            ->select(
                'siswa.id AS id_siswa',
                'siswa.nisn',
                'siswa.nama',
                'kelas.nama_kelas',
                DB::raw('COUNT(pelanggaran.id_pelanggaran) as total_kasus'),
                DB::raw('COALESCE(SUM(hukdis.poin), 0) as total_poin')
            )
            ->join('students AS siswa', 'grouping.id_siswa', '=', 'siswa.id')
            ->join('mst_kelas AS kelas', 'grouping.id_kelas', '=', 'kelas.id_kelas')
            ->leftJoin('tst_pelanggaran AS pelanggaran', function ($join) use ($filter) {
                $join->on('grouping.id_grouping', '=', 'pelanggaran.id_grouping');
                if (isset($filter['tanggal'])) {
                    $join->where('pelanggaran.tanggal', '=', $filter['tanggal']);
                }
                if (isset($filter['start_date']) && isset($filter['end_date'])) {
                    $join->whereBetween('pelanggaran.tanggal', [$filter['start_date'], $filter['end_date']]);
                }
                if (isset($filter['semester'])) {
                    $join->where('pelanggaran.semester', '=', $filter['semester']);
                }
            })
            ->leftJoin('mst_hukdis AS hukdis', 'pelanggaran.id_hukdis', '=', 'hukdis.id_hukdis')
            ->where('grouping.id_tahun', $tahun)
            ->whereIn('siswa.status', ['Aktif', 'A'])
            ->groupBy(
                'siswa.id',
                'siswa.nisn',
                'siswa.nama',
                'kelas.nama_kelas'
            );

        if ($id_kelas) {
            $query->where('grouping.id_kelas', $id_kelas);
        }

        return $query;
    }

    public function rekapHarian($id_kelas, $tahun, $tanggal)
    {
        return $this->baseQuery($id_kelas, $tahun, ['tanggal' => $tanggal])->get();
    }

    public function rekapRentangWaktu($id_kelas, $tahun, $start_date, $end_date)
    {
        return $this->baseQuery($id_kelas, $tahun, ['start_date' => $start_date, 'end_date' => $end_date])->get();
    }

    public function rekapSemester($id_kelas, $tahun, $semester)
    {
        return $this->baseQuery($id_kelas, $tahun, ['semester' => $semester])->get();
    }

    public function rekapTahunan($id_kelas, $tahun)
    {
        return $this->baseQuery($id_kelas, $tahun)->get();
    }
}
