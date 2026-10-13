<?php

namespace App\Services;

use App\Models\KomponenNilai;
use App\Models\PenetapanGuruMapel;
use App\Repositories\NilaiRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class NilaiService
{
    protected NilaiRepository $repository;

    public function __construct(NilaiRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Verifikasi kepemilikan penetapan guru mapel
     */
    protected function authorizePenetapan(int $id_penetapan, int $id_guru): PenetapanGuruMapel
    {
        $penetapan = PenetapanGuruMapel::findOrFail($id_penetapan);
        if ($penetapan->id_guru != $id_guru) {
            throw new Exception('Akses ditolak. Anda bukan pengampu kelas/mata pelajaran ini.');
        }

        return $penetapan;
    }

    /**
     * Verifikasi kepemilikan komponen nilai
     */
    protected function authorizeKomponen(int $id_komponen, int $id_guru): KomponenNilai
    {
        $komponen = KomponenNilai::with('penetapan')->findOrFail($id_komponen);
        if ($komponen->penetapan->id_guru != $id_guru) {
            throw new Exception('Akses ditolak. Anda tidak berhak mengubah komponen ini.');
        }

        return $komponen;
    }

    /**
     * Tambah komponen nilai baru
     */
    public function tambahKomponen(int $id_penetapan, int $id_guru, array $data): KomponenNilai
    {
        $this->authorizePenetapan($id_penetapan, $id_guru);

        $payload = [
            'id_penetapan' => $id_penetapan,
            'nama_komponen' => trim($data['nama_komponen']),
            'jenis' => $data['jenis'] ?? 'tugas',
            'bobot' => ! empty($data['bobot']) ? (int) $data['bobot'] : 1,
            'urutan' => ! empty($data['urutan']) ? (int) $data['urutan'] : 1,
        ];

        return $this->repository->createKomponen($payload);
    }

    /**
     * Update komponen nilai
     */
    public function updateKomponen(int $id_komponen, int $id_guru, array $data): KomponenNilai
    {
        $this->authorizeKomponen($id_komponen, $id_guru);

        $payload = [
            'nama_komponen' => trim($data['nama_komponen']),
            'jenis' => $data['jenis'] ?? 'tugas',
            'bobot' => ! empty($data['bobot']) ? (int) $data['bobot'] : 1,
            'urutan' => ! empty($data['urutan']) ? (int) $data['urutan'] : 1,
        ];

        $updated = $this->repository->updateKomponen($id_komponen, $payload);
        if (! $updated) {
            throw new Exception('Gagal memperbarui komponen nilai.');
        }

        return $updated;
    }

    /**
     * Hapus komponen nilai
     */
    public function hapusKomponen(int $id_komponen, int $id_guru): bool
    {
        $this->authorizeKomponen($id_komponen, $id_guru);

        return $this->repository->deleteKomponen($id_komponen);
    }

    /**
     * Simpan nilai batch untuk sebuah komponen
     */
    public function simpanNilaiBatch(int $id_komponen, int $id_guru, array $nilaiData): void
    {
        $this->authorizeKomponen($id_komponen, $id_guru);

        DB::transaction(function () use ($id_komponen, $nilaiData) {
            $this->repository->saveNilaiBatch($id_komponen, $nilaiData);
        });
    }
}
