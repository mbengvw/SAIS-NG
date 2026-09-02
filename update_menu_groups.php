

use App\Models\Menu;

$groups = [
    'DASHBOARD' => ['Dashboard Admin', 'Dashboard Piket', 'Dashboard Wali Kelas', 'Dashboard Guru Mapel'],
    'MASTER DATA' => ['Master Siswa', 'Master Kelas', 'Tahun Akademik', 'Master Hukdis', 'Master Mapel'],
    'AKADEMIK' => ['Pengkelasan', 'Penetapan Wali Kelas', 'Penetapan Mapel'],
    'KESISWAAN' => ['Absensi', 'Hukuman Disiplin', 'Rekap Presensi', 'Absensi Kelas', 'Detail Siswa', 'Rekap Pelanggaran', 'Monitoring Piket'],
    'LAYANAN & PERIZINAN' => ['Piket MBG', 'Rekap MBG', 'Izin Keluar', 'Approval Izin Keluar', 'Rekap Izin Keluar'],
    'PENGATURAN' => ['Manajemen Akun', 'Pengaturan Menu']
];

foreach ($groups as $groupName => $titles) {
    Menu::whereIn('title', $titles)->update(['group_name' => $groupName]);
}

echo "Menu groups updated successfully.\n";
