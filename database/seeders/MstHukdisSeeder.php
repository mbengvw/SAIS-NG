<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MstHukdisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hukdis_data = [
            ['deskripsi' => 'Terlambat masuk sekolah (lebih dari 15 menit)', 'poin' => 5],
            ['deskripsi' => 'Tidak memakai seragam sesuai ketentuan', 'poin' => 10],
            ['deskripsi' => 'Rambut gondrong / diwarnai (untuk siswa laki-laki)', 'poin' => 10],
            ['deskripsi' => 'Membolos / keluar area sekolah tanpa izin', 'poin' => 20],
            ['deskripsi' => 'Ketahuan merokok di lingkungan sekolah', 'poin' => 50],
            ['deskripsi' => 'Membawa senjata tajam atau barang berbahaya', 'poin' => 100],
            ['deskripsi' => 'Berkelahi di lingkungan sekolah', 'poin' => 75],
            ['deskripsi' => 'Merusak fasilitas sekolah', 'poin' => 30],
            ['deskripsi' => 'Membuang sampah sembarangan', 'poin' => 5],
            ['deskripsi' => 'Menggunakan HP saat KBM tanpa izin guru', 'poin' => 15],
        ];

        foreach ($hukdis_data as $data) {
            \Illuminate\Support\Facades\DB::table('mst_hukdis')->insert([
                'deskripsi' => $data['deskripsi'],
                'poin' => $data['poin'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
