<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use Spatie\Permission\Models\Role;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $piket = Role::firstOrCreate(['name' => 'guru-piket']);
        $walikelas = Role::firstOrCreate(['name' => 'wali-kelas']);

        // Data Menus
        $menus = [
            // Admin Menus
            [
                'title' => 'Dashboard Admin',
                'route_name' => 'admin.dashboard',
                'icon' => 'fa-dashboard',
                'color_class' => 'card-user',
                'order' => 1,
                'roles' => [$admin]
            ],
            [
                'title' => 'Master Siswa',
                'route_name' => 'siswa.index',
                'icon' => 'fa-users',
                'color_class' => 'card-siswa',
                'order' => 2,
                'roles' => [$admin]
            ],
            [
                'title' => 'Master Kelas',
                'route_name' => 'kelas.index',
                'icon' => 'fa-building',
                'color_class' => 'card-kelas',
                'order' => 3,
                'roles' => [$admin]
            ],
            [
                'title' => 'Pengkelasan',
                'route_name' => 'grouping.index',
                'icon' => 'fa-sitemap',
                'color_class' => 'card-grouping',
                'order' => 4,
                'roles' => [$admin]
            ],
            [
                'title' => 'Tahun Akademik',
                'route_name' => 'tahun.index',
                'icon' => 'fa-calendar-check-o',
                'color_class' => 'card-tahun',
                'order' => 5,
                'roles' => [$admin]
            ],
            [
                'title' => 'Master Hukdis',
                'route_name' => 'mst_hukdis.index',
                'icon' => 'fa-gavel',
                'color_class' => 'card-hukdis',
                'order' => 6,
                'roles' => [$admin]
            ],
            [
                'title' => 'Manajemen Akun',
                'route_name' => 'userman.index',
                'icon' => 'fa-user-circle',
                'color_class' => 'card-user',
                'order' => 7,
                'roles' => [$admin]
            ],
            [
                'title' => 'Pengaturan Menu',
                'route_name' => 'menus.index',
                'icon' => 'fa-list-ul',
                'color_class' => 'card-user',
                'order' => 8,
                'roles' => [$admin]
            ],
            // Piket Menus
            [
                'title' => 'Dashboard Piket',
                'route_name' => 'piket.index',
                'icon' => 'fa-dashboard',
                'color_class' => 'card-kelas', // Reuse some colors for Piket
                'order' => 8,
                'roles' => [$piket]
            ],
            [
                'title' => 'Absensi',
                'route_name' => 'presensi.index',
                'icon' => 'fa-check-square-o',
                'color_class' => 'card-siswa',
                'order' => 9,
                'roles' => [$piket]
            ],
            [
                'title' => 'Hukuman Disiplin',
                'route_name' => 'hukdis.index',
                'icon' => 'fa-warning',
                'color_class' => 'card-hukdis',
                'order' => 10,
                'roles' => [$piket]
            ],
            [
                'title' => 'Rekap Presensi',
                'route_name' => 'presensi.rekap',
                'icon' => 'fa-file-text-o',
                'color_class' => 'card-tahun',
                'order' => 11,
                'roles' => [$piket]
            ],
            // Walikelas Menus
            [
                'title' => 'Dashboard Wali Kelas',
                'route_name' => 'walas.index',
                'icon' => 'fa-dashboard',
                'color_class' => 'card-kelas',
                'order' => 12,
                'roles' => [$walikelas]
            ],
            [
                'title' => 'Jurnal',
                'route_name' => 'jurnal.index',
                'icon' => 'fa-book',
                'color_class' => 'card-siswa',
                'order' => 13,
                'roles' => [$walikelas]
            ],
            [
                'title' => 'Absensi Kelas',
                'route_name' => 'presensi.list',
                'icon' => 'fa-list-alt',
                'color_class' => 'card-tahun',
                'order' => 14,
                'roles' => [$walikelas]
            ],
            // Shared Menus
            [
                'title' => 'Detail Siswa',
                'route_name' => 'detail-siswa',
                'icon' => 'fa-address-card',
                'color_class' => 'card-siswa',
                'order' => 15,
                'roles' => [$admin, $piket, $walikelas]
            ],
            [
                'title' => 'Penetapan Wali Kelas',
                'route_name' => 'setwalas.index',
                'icon' => 'fa-id-badge',
                'color_class' => 'card-user',
                'order' => 16,
                'roles' => [$admin]
            ],
            [
                'title' => 'Rekap Pelanggaran',
                'route_name' => 'pelanggaran.rekap',
                'icon' => 'fa-pie-chart',
                'color_class' => 'card-hukdis',
                'order' => 11,
                'roles' => [$admin, $piket, $walikelas]
            ],
            // End of Menus
        ];

        foreach ($menus as $m) {
            $menu = Menu::updateOrCreate(
                ['route_name' => $m['route_name']],
                [
                    'title' => $m['title'],
                    'icon' => $m['icon'],
                    'color_class' => $m['color_class'],
                    'order' => $m['order']
                ]
            );

            // Sync roles
            $roleIds = array_map(function($role) { return $role->id; }, $m['roles']);
            $menu->roles()->sync($roleIds);
        }
    }
}
