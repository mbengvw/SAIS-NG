

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "Running migrations for missing tables...\n";
exec("php artisan migrate --force", $outputMigrate, $returnMigrate);
echo implode("\n", $outputMigrate) . "\n";

echo "Re-injecting menus...\n";
$menu = DB::table('menus')->where('route_name', 'setwalas.index')->first();
if (!$menu) {
    $menuId = DB::table('menus')->insertGetId([
        'title' => 'Penetapan Wali Kelas',
        'route_name' => 'setwalas.index',
        'icon' => 'fa-id-badge',
        'color_class' => 'card-user',
        'order' => 16,
        'is_active' => 1,
        'created_at' => now(),
        'updated_at' => now()
    ]);
} else {
    $menuId = $menu->id;
}
$roleAdmin = DB::table('roles')->where('name', 'admin')->first();
if ($roleAdmin) {
    if (Schema::hasTable('menu_role')) {
        $exists = DB::table('menu_role')->where('menu_id', $menuId)->where('role_id', $roleAdmin->id)->exists();
        if (!$exists) {
            DB::table('menu_role')->insert(['menu_id' => $menuId, 'role_id' => $roleAdmin->id]);
        }
    }
}
DB::table('menus')->where('route_name', 'presensi.rekap')->update(['title' => 'Laporan Presensi']);
DB::table('menus')->where('route_name', 'presensi.list')->update(['is_active' => 0]);
echo "Menus updated.\n";
