<?php

namespace App\Services;

use App\Repositories\StudentRepository;
use Exception;
use Illuminate\Support\Facades\Auth;

class StudentProfileService
{
    protected $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    /**
     * Update student profile securely
     */
    public function updateProfile(array $data)
    {
        $user = Auth::user();
        if (!$user->hasRole('siswa') || !$user->id_siswa) {
            throw new Exception('Akses ditolak.');
        }

        $student = $user->student;
        if (!$student) {
            throw new Exception('Data siswa tidak ditemukan.');
        }

        return $this->studentRepository->updateProfile($student->id, $data);
    }
}
