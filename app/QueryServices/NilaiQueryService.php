<?php

namespace App\QueryServices;

use App\Models\Grouping;
use App\Models\KomponenNilai;
use App\Models\NilaiSiswa;
use App\Models\PenetapanGuruMapel;
use Exception;

class NilaiQueryService
{
    /**
     * Memastikan guru memiliki akses ke penetapan dan mengembalikan objek penetapan
     */
    public function getPenetapanWithAkses(int $id_penetapan, int $id_guru): PenetapanGuruMapel
    {
        $penetapan = PenetapanGuruMapel::with(['kelas', 'mapel', 'tahun'])->findOrFail($id_penetapan);

        if ($penetapan->id_guru != $id_guru) {
            throw new Exception('Akses ditolak. Anda bukan pengampu kelas/mata pelajaran ini.');
        }

        return $penetapan;
    }

    /**
     * Mengambil daftar komponen penilaian untuk suatu penetapan
     */
    public function getKomponenByPenetapan(int $id_penetapan, int $id_guru)
    {
        $this->getPenetapanWithAkses($id_penetapan, $id_guru);

        return KomponenNilai::where('id_penetapan', $id_penetapan)
            ->withCount('nilaiSiswa')
            ->orderBy('urutan', 'asc')
            ->orderBy('id', 'asc')
            ->get();
    }

    /**
     * Mengambil detail satu komponen beserta verifikasi hak akses guru
     */
    public function getKomponenDetail(int $id_komponen, int $id_guru): KomponenNilai
    {
        $komponen = KomponenNilai::with(['penetapan.kelas', 'penetapan.mapel', 'penetapan.tahun'])
            ->findOrFail($id_komponen);

        if ($komponen->penetapan->id_guru != $id_guru) {
            throw new Exception('Akses ditolak.');
        }

        return $komponen;
    }

    /**
     * Mengambil daftar siswa di kelas penetapan beserta nilai pada komponen tertentu
     */
    public function getSiswaWithNilai(int $id_komponen, int $id_guru)
    {
        $komponen = $this->getKomponenDetail($id_komponen, $id_guru);
        $penetapan = $komponen->penetapan;

        $id_tahun = $penetapan->id_tahun;
        $id_kelas = $penetapan->id_kelas;

        $siswaList = Grouping::with('siswa')
            ->where('id_kelas', $id_kelas)
            ->where('id_tahun', $id_tahun)
            ->get()
            ->sortBy(function ($item) {
                return $item->siswa->nama ?? '';
            })
            ->values();

        $nilaiExisting = NilaiSiswa::where('id_komponen', $id_komponen)
            ->get()
            ->keyBy('id_siswa');

        return $siswaList->map(function ($grouping) use ($nilaiExisting) {
            $siswa = $grouping->siswa;
            $idSiswa = $siswa ? $siswa->id : $grouping->id_siswa;
            $recordNilai = $nilaiExisting->get($idSiswa);

            return [
                'id_siswa' => $idSiswa,
                'nama' => $siswa ? $siswa->nama : '-',
                'nisn' => $siswa ? $siswa->nisn : '-',
                'jenis_kelamin' => $siswa ? $siswa->jenis_kelamin : '-',
                'nilai' => $recordNilai ? $recordNilai->nilai : null,
                'catatan' => $recordNilai ? $recordNilai->catatan : null,
            ];
        });
    }

    /**
     * Rekap seluruh nilai kelas: daftar siswa, semua komponen, nilai per siswa, dan rata-rata
     */
    public function getRekapNilaiKelas(int $id_penetapan, int $id_guru): array
    {
        $penetapan = $this->getPenetapanWithAkses($id_penetapan, $id_guru);
        $komponenList = KomponenNilai::where('id_penetapan', $id_penetapan)
            ->orderBy('urutan', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        $siswaList = Grouping::with('siswa')
            ->where('id_kelas', $penetapan->id_kelas)
            ->where('id_tahun', $penetapan->id_tahun)
            ->get()
            ->sortBy(function ($item) {
                return $item->siswa->nama ?? '';
            })
            ->values();

        $komponenIds = $komponenList->pluck('id')->toArray();
        $semuaNilai = NilaiSiswa::whereIn('id_komponen', $komponenIds)->get();

        $matrixNilai = [];
        foreach ($semuaNilai as $n) {
            $matrixNilai[$n->id_siswa][$n->id_komponen] = $n->nilai;
        }

        $rekapSiswa = $siswaList->map(function ($grouping) use ($komponenList, $matrixNilai) {
            $siswa = $grouping->siswa;
            $idSiswa = $siswa ? $siswa->id : $grouping->id_siswa;

            $nilaiSiswa = [];
            $totalNilai = 0;
            $jumlahTerisi = 0;

            foreach ($komponenList as $komp) {
                $val = $matrixNilai[$idSiswa][$komp->id] ?? null;
                $nilaiSiswa[$komp->id] = $val;
                if ($val !== null && is_numeric($val)) {
                    $totalNilai += (float) $val;
                    $jumlahTerisi++;
                }
            }

            $rataRata = $jumlahTerisi > 0 ? round($totalNilai / $jumlahTerisi, 2) : null;

            return [
                'id_siswa' => $idSiswa,
                'nama' => $siswa ? $siswa->nama : '-',
                'nisn' => $siswa ? $siswa->nisn : '-',
                'jenis_kelamin' => $siswa ? $siswa->jenis_kelamin : '-',
                'nilai_komponen' => $nilaiSiswa,
                'rata_rata' => $rataRata,
                'jumlah_terisi' => $jumlahTerisi,
            ];
        });

        return [
            'penetapan' => $penetapan,
            'komponen' => $komponenList,
            'rekap' => $rekapSiswa,
        ];
    }
}
