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
echo "Menu ID: " . $menuId;
