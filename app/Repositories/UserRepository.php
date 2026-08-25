<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserRepository
{
    /**
     * Get a user account by id_siswa
     */
    public function getAccountBySiswaId($id_siswa)
    {
        return User::where('id_siswa', $id_siswa)->first();
    }

    /**
     * Check if email is already taken by someone else
     */
    public function isEmailTaken($email)
    {
        return User::where('email', $email)->exists();
    }

    /**
     * Update user email
     */
    public function updateEmail($userId, $newEmail)
    {
        $user = User::find($userId);
        if ($user) {
            $user->update(['email' => $newEmail]);
            return true;
        }
        return false;
    }

    /**
     * Create a new student account
     */
    public function createStudentAccount(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'id_siswa' => $data['id_siswa']
        ]);

        $role = Role::firstOrCreate(['name' => 'siswa']);
        $user->assignRole($role);

        return $user;
    }
}
