<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class RekapPresensiService
{

    public function all($semster)
    {
        $list_rekap = DB::select('
            SELECT `id_grouping`,
            SUM(CASE 
                WHEN `status`="S" THEN 1 
                ELSE 0
                END) AS sakit,
            SUM(CASE WHEN `status`="I" THEN 1 
                ELSE 0
                END) AS izin,
            SUM(CASE WHEN `status`="A" THEN 1 
                ELSE 0
                END) AS alfa,
            SUM(CASE WHEN `status`IS NOT NULL THEN 1 
                ELSE 0
                END) AS total
            FROM tst_kehadiran
            WHERE `semester`=?
            GROUP BY id_grouping
            ',[$semster]);

        return $list_rekap;
    }

    public function rekapByKelasTahunSemeseter($id_kelas,$tahun,$semester)
    {
        $res = DB::select('
        SELECT * FROM
            (SELECT G.*,S.nama,S.nisn FROM
                (SELECT * FROM `tst_grouping` WHERE `id_kelas`=? AND `tahun`=?) AS G
                LEFT JOIN students AS S ON G.id_siswa=S.id
                ORDER BY S.nama) AS LS
            LEFT JOIN (
                SELECT `id_grouping`,
                SUM(CASE 
                    WHEN `status`="S" THEN 1 
                    ELSE 0
                    END) AS sakit,
                SUM(CASE WHEN `status`="I" THEN 1 
                    ELSE 0
                    END) AS izin,
                SUM(CASE WHEN `status`="A" THEN 1 
                    ELSE 0
                    END) AS alfa,
                SUM(CASE WHEN `status`IS NOT NULL THEN 1 
                    ELSE 0
                    END) AS total
                FROM tst_kehadiran
                WHERE `semester`=?
                GROUP BY id_grouping) AS P
            ON LS.id_grouping = P.id_grouping
        ',[$id_kelas,$tahun,$semester]);

        return $res;
    }

    public function rekapByKelasTahunBulan($id_kelas, $tahun, $bulan)
    {
        $res = DB::select('
        SELECT * FROM
            (SELECT G.*,S.nama,S.nisn FROM
                (SELECT * FROM `tst_grouping` WHERE `id_kelas`=? AND `tahun`=?) AS G
                LEFT JOIN students AS S ON G.id_siswa=S.id
                ORDER BY S.nama) AS LS
            LEFT JOIN (
                SELECT `id_grouping`,
                SUM(CASE 
                    WHEN `status`="S" THEN 1 
                    ELSE 0
                    END) AS sakit,
                SUM(CASE WHEN `status`="I" THEN 1 
                    ELSE 0
                    END) AS izin,
                SUM(CASE WHEN `status`="A" THEN 1 
                    ELSE 0
                    END) AS alfa,
                SUM(CASE WHEN `status`IS NOT NULL THEN 1 
                    ELSE 0
                    END) AS total
                FROM tst_kehadiran
                WHERE MONTH(tanggal)=? AND YEAR(tanggal)=?
                GROUP BY id_grouping) AS P
            ON LS.id_grouping = P.id_grouping
        ', [$id_kelas, $tahun, $bulan,$tahun]);
        return $res;
    }
}
