<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class WalikelasDashboardService
{
    public function getDashboardMetrics($id_kelas, $tahun_id, $tahun_name, $semester)
    {
        $metrics = [
            'summary' => [],
            'pie_presensi' => [],
            'top_absen' => [],
            'trend_absensi' => [],
            'distribusi_hukdis' => [],
            'top_pelanggar' => []
        ];

        // 1. SUMMARY CARDS & PIE CHART PRESENSI (Semester Berjalan)
        // Hitung total S, I, A, H dari tst_kehadiran untuk kelas ini
        $presensi = DB::select('
            SELECT 
                SUM(CASE WHEN k.status = "S" THEN 1 ELSE 0 END) as sakit,
                SUM(CASE WHEN k.status = "I" THEN 1 ELSE 0 END) as izin,
                SUM(CASE WHEN k.status = "A" THEN 1 ELSE 0 END) as alfa,
                SUM(CASE WHEN k.status = "H" THEN 1 ELSE 0 END) as hadir
            FROM tst_kehadiran k
            JOIN tst_grouping g ON k.id_grouping = g.id_grouping
            WHERE g.id_kelas = ? AND g.id_tahun = ? AND k.semester = ?
        ', [$id_kelas, $tahun_id, $semester]);
        
        $p = $presensi[0];
        $metrics['pie_presensi'] = [
            'Sakit' => (int)$p->sakit,
            'Izin' => (int)$p->izin,
            'Alfa' => (int)$p->alfa,
            'Hadir' => (int)$p->hadir,
        ];
        $metrics['summary']['total_alfa'] = (int)$p->alfa;
        $metrics['summary']['total_sakit_izin'] = (int)$p->sakit + (int)$p->izin;

        // 2. TOP 5 SISWA ABSEN TERBANYAK (S, I, A)
        $top_absen = DB::select('
            SELECT s.nama, 
                   SUM(CASE WHEN k.status IN ("S", "I", "A") THEN 1 ELSE 0 END) as total_absen,
                   SUM(CASE WHEN k.status = "A" THEN 1 ELSE 0 END) as alfa,
                   SUM(CASE WHEN k.status = "S" THEN 1 ELSE 0 END) as sakit,
                   SUM(CASE WHEN k.status = "I" THEN 1 ELSE 0 END) as izin
            FROM tst_kehadiran k
            JOIN tst_grouping g ON k.id_grouping = g.id_grouping
            JOIN students s ON g.id_siswa = s.id
            WHERE g.id_kelas = ? AND g.id_tahun = ? AND k.semester = ?
            GROUP BY s.id, s.nama
            HAVING total_absen > 0
            ORDER BY total_absen DESC, alfa DESC
            LIMIT 5
        ', [$id_kelas, $tahun_id, $semester]);
        $metrics['top_absen'] = $top_absen;

        // 3. TREN ABSENSI PER BULAN (Semester Berjalan)
        $tren = DB::select('
            SELECT 
                MONTH(k.tanggal) as bulan,
                MONTHNAME(k.tanggal) as nama_bulan,
                SUM(CASE WHEN k.status = "A" THEN 1 ELSE 0 END) as alfa,
                SUM(CASE WHEN k.status = "S" THEN 1 ELSE 0 END) as sakit,
                SUM(CASE WHEN k.status = "I" THEN 1 ELSE 0 END) as izin
            FROM tst_kehadiran k
            JOIN tst_grouping g ON k.id_grouping = g.id_grouping
            WHERE g.id_kelas = ? AND g.id_tahun = ? AND k.semester = ?
            GROUP BY bulan, nama_bulan
            ORDER BY bulan ASC
        ', [$id_kelas, $tahun_id, $semester]);
        $metrics['trend_absensi'] = $tren;

        // 4. SUMMARY HUKDIS (Pelanggaran) & DISTRIBUSI HUKDIS & TOP PELANGGAR
        $hukdis = DB::select('
            SELECT p.id_hukdis, h.deskripsi, h.poin, s.nama
            FROM tst_pelanggaran p
            JOIN tst_grouping g ON p.id_grouping = g.id_grouping
            JOIN mst_hukdis h ON p.id_hukdis = h.id_hukdis
            JOIN students s ON g.id_siswa = s.id
            WHERE g.id_kelas = ? AND g.id_tahun = ? AND p.semester = ?
        ', [$id_kelas, $tahun_id, $semester]);

        $metrics['summary']['total_pelanggaran'] = count($hukdis);
        
        $distribusi = [];
        $siswa_pelanggar = [];
        $max_poin = 0;

        foreach ($hukdis as $h) {
            // Distribusi Jenis Pelanggaran
            if (!isset($distribusi[$h->deskripsi])) {
                $distribusi[$h->deskripsi] = 0;
            }
            $distribusi[$h->deskripsi]++;

            // Hitung poin per siswa
            if (!isset($siswa_pelanggar[$h->nama])) {
                $siswa_pelanggar[$h->nama] = 0;
            }
            $siswa_pelanggar[$h->nama] += $h->poin;
        }

        arsort($distribusi); // Urutkan frekuensi pelanggaran terbanyak
        $metrics['distribusi_hukdis'] = array_slice($distribusi, 0, 5); // Ambil 5 terbanyak

        arsort($siswa_pelanggar); // Urutkan siswa dengan poin tertinggi
        $metrics['top_pelanggar'] = array_slice($siswa_pelanggar, 0, 5);
        
        if (count($siswa_pelanggar) > 0) {
            $metrics['summary']['poin_tertinggi'] = reset($siswa_pelanggar); // Get the first (highest) value
        } else {
            $metrics['summary']['poin_tertinggi'] = 0;
        }

        return $metrics;
    }
}
