<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            'DASHBOARD' => ['Dashboard Admin', 'Dashboard Piket', 'Dashboard Wali Kelas', 'Dashboard Guru Mapel'],
            'MASTER DATA' => ['Master Siswa', 'Master Kelas', 'Tahun Akademik', 'Master Hukdis', 'Master Mapel'],
            'AKADEMIK' => ['Pengkelasan', 'Penetapan Wali Kelas', 'Penetapan Mapel'],
            'KESISWAAN' => ['Absensi', 'Hukuman Disiplin', 'Rekap Presensi', 'Absensi Kelas', 'Detail Siswa', 'Rekap Pelanggaran', 'Monitoring Piket'],
            'LAYANAN & PERIZINAN' => ['Piket MBG', 'Rekap MBG', 'Izin Keluar', 'Approval Izin Keluar', 'Rekap Izin Keluar'],
            'PENGATURAN' => ['Manajemen Akun', 'Pengaturan Menu']
        ];
        
        foreach ($groups as $groupName => $titles) {
            \App\Models\Menu::whereIn('title', $titles)->update(['group_name' => $groupName]);
        }
    }
}
