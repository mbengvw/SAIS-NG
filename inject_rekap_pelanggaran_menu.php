

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "Injecting Rekap Pelanggaran menu...\n";

// Get order of Hukdis menu
$hukdisMenu = DB::table('menus')->where('route_name', 'hukdis.index')->first();
$order = $hukdisMenu ? $hukdisMenu->order + 1 : 12;

$menu = DB::table('menus')->where('route_name', 'pelanggaran.rekap')->first();
if (!$menu) {
    $menuId = DB::table('menus')->insertGetId([
        'title' => 'Rekap Pelanggaran',
        'route_name' => 'pelanggaran.rekap',
        'icon' => 'fa-pie-chart',
        'color_class' => 'card-hukdis',
        'order' => $order,
        'is_active' => 1,
        'created_at' => now(),
        'updated_at' => now()
    ]);
} else {
    $menuId = $menu->id;
}

// Assign to Admin
$roleAdmin = DB::table('roles')->where('name', 'admin')->first();
if ($roleAdmin && Schema::hasTable('menu_role')) {
    $exists = DB::table('menu_role')->where('menu_id', $menuId)->where('role_id', $roleAdmin->id)->exists();
    if (!$exists) DB::table('menu_role')->insert(['menu_id' => $menuId, 'role_id' => $roleAdmin->id]);
}

// Assign to Piket
$rolePiket = DB::table('roles')->where('name', 'guru-piket')->first();
if ($rolePiket && Schema::hasTable('menu_role')) {
    $exists = DB::table('menu_role')->where('menu_id', $menuId)->where('role_id', $rolePiket->id)->exists();
    if (!$exists) DB::table('menu_role')->insert(['menu_id' => $menuId, 'role_id' => $rolePiket->id]);
}

// Assign to Walikelas
$roleWalas = DB::table('roles')->where('name', 'walikelas')->first();
if ($roleWalas && Schema::hasTable('menu_role')) {
    $exists = DB::table('menu_role')->where('menu_id', $menuId)->where('role_id', $roleWalas->id)->exists();
    if (!$exists) DB::table('menu_role')->insert(['menu_id' => $menuId, 'role_id' => $roleWalas->id]);
}

echo "Menu Rekap Pelanggaran successfully injected.\n";
