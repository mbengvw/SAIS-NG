<?php

namespace App\Repositories;

use App\Models\KomponenNilai;
use App\Models\NilaiSiswa;

class NilaiRepository
{
    /**
     * Menyimpan komponen nilai baru
     */
    public function createKomponen(array $data): KomponenNilai
    {
        return KomponenNilai::create($data);
    }

    /**
     * Memperbarui komponen nilai
     */
    public function updateKomponen(int $id, array $data): ?KomponenNilai
    {
        $komponen = KomponenNilai::find($id);
        if ($komponen) {
            $komponen->update($data);

            return $komponen;
        }

        return null;
    }

    /**
     * Menghapus komponen nilai beserta seluruh nilai yang berelasi
     */
    public function deleteKomponen(int $id): bool
    {
        $komponen = KomponenNilai::find($id);
        if ($komponen) {
            return (bool) $komponen->delete();
        }

        return false;
    }

    /**
     * Menyimpan atau memperbarui nilai siswa secara batch untuk satu komponen
     * $items format: [ ['id_siswa' => 1, 'nilai' => 85.5, 'catatan' => '...'], ... ]
     */
    public function saveNilaiBatch(int $id_komponen, array $items): void
    {
        foreach ($items as $item) {
            $idSiswa = $item['id_siswa'];
            $nilai = ($item['nilai'] !== '' && $item['nilai'] !== null) ? (float) $item['nilai'] : null;
            $catatan = $item['catatan'] ?? null;

            NilaiSiswa::updateOrCreate(
                [
                    'id_komponen' => $id_komponen,
                    'id_siswa' => $idSiswa,
                ],
                [
                    'nilai' => $nilai,
                    'catatan' => $catatan,
                ]
            );
        }
    }
}
