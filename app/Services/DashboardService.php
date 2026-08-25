<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardService
{
    public function getWidgetStats($id_tahun)
    {
        $currentMonth = date('m');
        $currentYear = date('Y');

        $total_siswa = DB::table('students')->whereIn('status', ['Aktif', 'A'])->count();
        
        $total_kelas = DB::table('tst_grouping')
            ->where('id_tahun', $id_tahun)
            ->distinct('id_kelas')
            ->count('id_kelas');

        $total_kasus_bulan_ini = DB::table('tst_pelanggaran')
            ->join('tst_grouping', 'tst_pelanggaran.id_grouping', '=', 'tst_grouping.id_grouping')
            ->where('tst_grouping.id_tahun', $id_tahun)
            ->whereMonth('tst_pelanggaran.tanggal', $currentMonth)
            ->whereYear('tst_pelanggaran.tanggal', $currentYear)
            ->count();

        $total_absen_bulan_ini = DB::table('tst_kehadiran')
            ->join('tst_grouping', 'tst_kehadiran.id_grouping', '=', 'tst_grouping.id_grouping')
            ->where('tst_grouping.id_tahun', $id_tahun)
            ->whereIn('tst_kehadiran.status', ['S', 'I', 'A'])
            ->whereMonth('tst_kehadiran.tanggal', $currentMonth)
            ->whereYear('tst_kehadiran.tanggal', $currentYear)
            ->count();

        return [
            'total_siswa' => $total_siswa,
            'total_kelas' => $total_kelas,
            'total_kasus_bulan_ini' => $total_kasus_bulan_ini,
            'total_absen_bulan_ini' => $total_absen_bulan_ini,
        ];
    }

    public function getTopKelasPelanggaran($id_tahun)
    {
        return DB::table('tst_pelanggaran as p')
            ->join('tst_grouping as g', 'p.id_grouping', '=', 'g.id_grouping')
            ->join('mst_kelas as k', 'g.id_kelas', '=', 'k.id_kelas')
            ->join('mst_hukdis as h', 'p.id_hukdis', '=', 'h.id_hukdis')
            ->where('g.id_tahun', $id_tahun)
            ->select('k.nama_kelas', DB::raw('SUM(h.poin) as total_poin'), DB::raw('COUNT(p.id_pelanggaran) as total_kasus'))
            ->groupBy('k.nama_kelas')
            ->orderByDesc('total_poin')
            ->limit(5)
            ->get();
    }

    public function getTopSiswaPelanggaran($id_tahun)
    {
        return DB::table('tst_pelanggaran as p')
            ->join('tst_grouping as g', 'p.id_grouping', '=', 'g.id_grouping')
            ->join('students as s', 'g.id_siswa', '=', 's.id')
            ->join('mst_kelas as k', 'g.id_kelas', '=', 'k.id_kelas')
            ->join('mst_hukdis as h', 'p.id_hukdis', '=', 'h.id_hukdis')
            ->where('g.id_tahun', $id_tahun)
            ->whereIn('s.status', ['Aktif', 'A'])
            ->select('s.nama', 'k.nama_kelas', DB::raw('SUM(h.poin) as total_poin'), DB::raw('COUNT(p.id_pelanggaran) as total_kasus'))
            ->groupBy('s.id', 's.nama', 'k.nama_kelas')
            ->orderByDesc('total_poin')
            ->limit(5)
            ->get();
    }

    public function getTrendPelanggaranBulanan($id_tahun)
    {
        $raw = DB::table('tst_pelanggaran as p')
            ->join('tst_grouping as g', 'p.id_grouping', '=', 'g.id_grouping')
            ->where('g.id_tahun', $id_tahun)
            ->select(
                DB::raw('MONTH(p.tanggal) as bulan'),
                DB::raw('COUNT(p.id_pelanggaran) as total')
            )
            ->groupBy(DB::raw('MONTH(p.tanggal)'))
            ->orderBy(DB::raw('MONTH(p.tanggal)'))
            ->get();

        return $this->formatMonthlyTrend($raw);
    }

    public function getTrendPresensiBulanan($id_tahun)
    {
        $raw = DB::table('tst_kehadiran as k')
            ->join('tst_grouping as g', 'k.id_grouping', '=', 'g.id_grouping')
            ->where('g.id_tahun', $id_tahun)
            ->whereIn('k.status', ['S', 'I', 'A'])
            ->select(
                DB::raw('MONTH(k.tanggal) as bulan'),
                DB::raw('COUNT(k.id_kehadiran) as total')
            )
            ->groupBy(DB::raw('MONTH(k.tanggal)'))
            ->orderBy(DB::raw('MONTH(k.tanggal)'))
            ->get();

        return $this->formatMonthlyTrend($raw);
    }

    private function formatMonthlyTrend($rawData)
    {
        $months = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun',
            7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
        ];
        
        $labels = [];
        $data = [];

        $academicMonths = [7, 8, 9, 10, 11, 12, 1, 2, 3, 4, 5, 6];

        foreach ($academicMonths as $m) {
            $labels[] = $months[$m];
            
            $found = $rawData->firstWhere('bulan', $m);
            $data[] = $found ? $found->total : 0;
        }

        return [
            'labels' => $labels,
            'data' => $data
        ];
    }
}
