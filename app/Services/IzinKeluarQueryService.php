<?php

namespace App\Services;

use App\Models\TrxIzinKeluar;
use Illuminate\Support\Facades\DB;

class IzinKeluarQueryService
{
    /**
     * Get list of izin by status for a specific date
     */
    public function getListByStatusAndDate($status, $date)
    {
        return TrxIzinKeluar::with(['siswa', 'kelas', 'guruPemberi', 'piketKeluar'])
            ->where('status', $status)
            ->where('tanggal', $date)
            ->orderBy('waktu_keluar', 'desc')
            ->get();
    }

    /**
     * Get list of izin for a specific guru
     */
    public function getListByGuruPemberiAndDate($id_guru, $date)
    {
        return TrxIzinKeluar::with(['siswa', 'kelas'])
            ->where('id_guru_pemberi', $id_guru)
            ->where('tanggal', $date)
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * Build query for datatables (laporan/rekap)
     */
    public function getRekapQuery($start_date = null, $end_date = null, $id_kelas = null)
    {
        $query = TrxIzinKeluar::with(['siswa', 'kelas', 'guruPemberi', 'piketKeluar', 'piketKembali'])
            ->select('trx_izin_keluar.*');

        if ($start_date && $end_date) {
            $query->whereBetween('tanggal', [$start_date, $end_date]);
        } else {
            $query->where('tanggal', date('Y-m-d'));
        }

        if ($id_kelas) {
            $query->where('id_kelas', $id_kelas);
        }

        return $query;
    }
}
