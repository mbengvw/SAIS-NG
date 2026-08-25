
use Illuminate\Support\Facades\DB;
use App\Services\TahunService;

// Cari tahun akademik aktif
$tahun = TahunService::getActive();
if (!$tahun) {
    echo "Tidak ada tahun akademik aktif!\n";
    exit;
}

// id_kelas 10.A adalah 21
$id_kelas = 21;

// Ambil siswa-siswa di kelas 10.A
$groupings = DB::table('tst_grouping')
    ->where('id_kelas', $id_kelas)
    ->where('id_tahun', $tahun->id)
    ->get();

if ($groupings->isEmpty()) {
    echo "Tidak ada siswa di kelas 10.A untuk tahun ini.\n";
    exit;
}

// Admin / user id untuk log
$petugas = DB::table('users')->where('id', 1)->first();
$id_petugas = $petugas ? $petugas->id : 1;

$start = \Carbon\Carbon::create(2026, 5, 1);
$end = \Carbon\Carbon::create(2026, 6, 30);
$current = $start->copy();

$logCount = 0;
$absensiCount = 0;

$statusPilihan = ['S', 'I', 'A'];

while ($current->lte($end)) {
    // Hanya hari Senin sampai Jumat (Weekday)
    if ($current->isWeekday()) {
        $tanggal = $current->format('Y-m-d');
        
        // 1. Simpan log_presensi_kelas agar hari ini dihitung sebagai hari efektif
        DB::table('log_presensi_kelas')->insert([
            'id_kelas' => $id_kelas,
            'tanggal' => $tanggal,
            'id_user' => $id_petugas,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $logCount++;
        
        // 2. Beri probabilitas 30% hari ini ada anak yang tidak masuk
        if (rand(1, 100) <= 30) {
            // Ada 1 sampai 3 anak yang absen/sakit/izin
            $jumlahAbsen = rand(1, 3);
            
            // Pilih murid random yang absen hari ini
            $absenStudents = $groupings->random($jumlahAbsen);
            
            foreach($absenStudents as $siswa) {
                // Pilih status random (S, I, atau A)
                $statusRandom = $statusPilihan[array_rand($statusPilihan)];
                $keterangan = "";
                if ($statusRandom == 'S') $keterangan = "Surat dokter";
                else if ($statusRandom == 'I') $keterangan = "Acara keluarga";
                else $keterangan = "Tanpa keterangan";
                
                DB::table('tst_kehadiran')->insert([
                    'id_grouping' => $siswa->id_grouping,
                    'semester' => $tahun->semester,
                    'tanggal' => $tanggal,
                    'status' => $statusRandom,
                    'keterangan' => $keterangan,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                $absensiCount++;
            }
        }
    }
    $current->addDay();
}

echo "Berhasil membuat $logCount hari efektif (log) dan $absensiCount data absen (S/I/A) untuk kelas 10.A di bulan Juli dan Agustus!\n";
