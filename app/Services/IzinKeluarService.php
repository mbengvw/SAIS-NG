<?php

namespace App\Services;

use App\Repositories\IzinKeluarRepository;

class IzinKeluarService
{
    protected $repository;

    public function __construct(IzinKeluarRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Pengajuan Izin Keluar oleh Guru Mapel
     */
    public function ajukanIzin(array $data)
    {
        $data['tanggal'] = date('Y-m-d');
        $data['status'] = 'menunggu'; // Default menunggu approval piket
        $data['is_pulang'] = isset($data['is_pulang']) ? (bool) $data['is_pulang'] : false;

        return $this->repository->create($data);
    }

    /**
     * Approval Keluar oleh Guru Piket
     */
    public function approveKeluar($id, $id_user_piket)
    {
        $data = [
            'status' => 'keluar',
            'waktu_keluar' => now(),
            'id_user_piket_keluar' => $id_user_piket
        ];
        return $this->repository->update($id, $data);
    }

    /**
     * Lapor Kembali oleh Guru Piket
     */
    public function laporKembali($id, $id_user_piket)
    {
        $data = [
            'status' => 'kembali',
            'waktu_kembali' => now(),
            'id_user_piket_kembali' => $id_user_piket
        ];
        return $this->repository->update($id, $data);
    }

    /**
     * Batalkan/Hapus Pengajuan (Opsional)
     */
    public function batalkanIzin($id)
    {
        // jika menggunakan soft delete atau hard delete di repository
        // $this->repository->delete($id);
    }
}
