<?php

namespace App\QueryServices;

use Illuminate\Support\Facades\Auth;
use Exception;

class StudentQueryService
{
    /**
     * Get the currently logged-in student's profile for the dashboard (Read-Only)
     */
    public function getStudentProfile()
    {
        $user = Auth::user();
        
        if (!$user->hasRole('siswa') || !$user->id_siswa) {
            throw new Exception('Akses ditolak.');
        }

        $student = $user->student;
        if (!$student) {
            throw new Exception('Data siswa tidak ditemukan.');
        }

        return $student;
    }
}
