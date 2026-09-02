

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "Injecting Master Mapel & Penetapan Guru Mapel menus...\n";

// Get order of Kelas menu
$kelasMenu = DB::table('menus')->where('route_name', 'kelas.index')->first();
$order = $kelasMenu ? $kelasMenu->order + 1 : 15;

// Master Mapel
$menuMapel = DB::table('menus')->where('route_name', 'master.mapel.index')->first();
if (!$menuMapel) {
    $mapelId = DB::table('menus')->insertGetId([
        'title' => 'Master Mapel',
        'route_name' => 'master.mapel.index',
        'icon' => 'fa-book',
        'color_class' => 'card-primary',
        'order' => $order,
        'is_active' => 1,
        'created_at' => now(),
        'updated_at' => now()
    ]);
} else {
    $mapelId = $menuMapel->id;
}

// Penetapan Guru Mapel
$menuPenetapan = DB::table('menus')->where('route_name', 'master.penetapan.index')->first();
if (!$menuPenetapan) {
    $penetapanId = DB::table('menus')->insertGetId([
        'title' => 'Penetapan Mapel',
        'route_name' => 'master.penetapan.index',
        'icon' => 'fa-users',
        'color_class' => 'card-primary',
        'order' => $order + 1,
        'is_active' => 1,
        'created_at' => now(),
        'updated_at' => now()
    ]);
} else {
    $penetapanId = $menuPenetapan->id;
}

// Assign to Admin
$roleAdmin = DB::table('roles')->where('name', 'admin')->first();
if ($roleAdmin && Schema::hasTable('menu_role')) {
    $existsMapel = DB::table('menu_role')->where('menu_id', $mapelId)->where('role_id', $roleAdmin->id)->exists();
    if (!$existsMapel) DB::table('menu_role')->insert(['menu_id' => $mapelId, 'role_id' => $roleAdmin->id]);
    
    $existsPenetapan = DB::table('menu_role')->where('menu_id', $penetapanId)->where('role_id', $roleAdmin->id)->exists();
    if (!$existsPenetapan) DB::table('menu_role')->insert(['menu_id' => $penetapanId, 'role_id' => $roleAdmin->id]);
}

echo "Menus successfully injected.\n";
