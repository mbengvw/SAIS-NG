<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\PermissionRegistrar;

class RoleAndUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Membuat Roles
        $roles = [
            'admin',
            'guru-piket',
            'wali-kelas',
            'guru-mapel',
            'siswa'
        ];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // 2. Membuat Users untuk masing-masing Role
        $usersData = [
            [
                'name' => 'Admin Sistem',
                'email' => 'admin@example.com',
                'role' => 'admin',
                'admin' => 1,
            ],
            [
                'name' => 'Bapak Guru Piket',
                'email' => 'piket@example.com',
                'role' => 'guru-piket',
                'admin' => 0,
            ],
            [
                'name' => 'Ibu Wali Kelas',
                'email' => 'walikelas@example.com',
                'role' => 'wali-kelas',
                'admin' => 0,
            ],
            [
                'name' => 'Bapak Guru Mapel',
                'email' => 'gurumapel@example.com',
                'role' => 'guru-mapel',
                'admin' => 0,
            ],
            [
                'name' => 'Siswa Teladan',
                'email' => 'siswa@example.com',
                'role' => 'siswa',
                'admin' => 0,
            ],
        ];

        foreach ($usersData as $data) {
            // Membuat user
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('password'), // password default: password
                    'admin' => $data['admin']
                ]
            );

            // Assign role ke user tersebut
            // Cek dulu apakah user belum punya role ini agar tidak duplikat assign
            if (!$user->hasRole($data['role'])) {
                $user->assignRole($data['role']);
            }
        }
    }
}
