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

// Ambil semua hukdis yang tersedia
$hukdisList = DB::table('mst_hukdis')->get();

if ($hukdisList->isEmpty()) {
    echo "Tabel mst_hukdis kosong!\n";
    exit;
}

// Generate sekitar 20 - 30 kasus pelanggaran secara random
$jumlahKasus = rand(20, 30);
echo "Membuat $jumlahKasus data pelanggaran dummy untuk kelas 10.A...\n";

// ID Petugas (Admin/Piket) dummy, ambil user dengan role admin/guru-piket
$petugas = DB::table('users')->where('id', 1)->first(); // asumsi id 1 adalah admin
$id_petugas = $petugas ? $petugas->id : 1;

for ($i = 0; $i < $jumlahKasus; $i++) {
    // Pilih siswa acak dari kelas 10.A
    $randomStudent = $groupings->random();
    
    // Pilih pelanggaran acak
    $randomHukdis = $hukdisList->random();
    
    // Pilih tanggal acak antara 1 Mei 2026 sampai 30 Juni 2026
    $start = \Carbon\Carbon::create(2026, 5, 1);
    $end = \Carbon\Carbon::create(2026, 6, 30);
    
    // Asumsikan kita jalankan di tahun yang sesuai, atau hardcode 2026
    $randomTimestamp = mt_rand($start->timestamp, $end->timestamp);
    $randomDate = \Carbon\Carbon::createFromTimestamp($randomTimestamp)->format('Y-m-d');
    
    DB::table('tst_pelanggaran')->insert([
        'id_hukdis' => $randomHukdis->id_hukdis,
        'id_grouping' => $randomStudent->id_grouping,
        'tanggal' => $randomDate,
        'semester' => $tahun->semester,
        'id_petugas' => $id_petugas,
        'created_at' => now(),
        'updated_at' => now()
    ]);
}

echo "Berhasil membuat data dummy pelanggaran untuk kelas 10.A di bulan Juli dan Agustus!\n";
