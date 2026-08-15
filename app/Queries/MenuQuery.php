<?php

namespace App\Queries;

use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class MenuQuery
{
    public static function getMenusForUser($user)
    {
        if (!$user) {
            return collect([]);
        }

        // Ambil semua role Spatie
        $roleNames = $user->getRoleNames()->toArray();
        
        // Tambahkan role wali-kelas jika user adalah wali kelas aktif
        if (method_exists($user, 'isWalikelas') && $user->isWalikelas() && !in_array('wali-kelas', $roleNames)) {
            $roleNames[] = 'wali-kelas';
        }

        return Menu::whereHas('roles', function ($query) use ($roleNames) {
                $query->whereIn('name', $roleNames);
            })
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
    }
}
