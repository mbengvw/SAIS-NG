<?php

namespace App\Services;

use App\Repositories\StudentRepository;
use App\Repositories\UserRepository;

class StudentAccountService
{
    protected $studentRepository;
    protected $userRepository;

    public function __construct(StudentRepository $studentRepository, UserRepository $userRepository)
    {
        $this->studentRepository = $studentRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Generate user accounts for all active students that don't have one
     */
    public function generateAccounts()
    {
        $students = $this->studentRepository->getActiveStudents();
        $countNew = 0;
        $countSynced = 0;

        foreach ($students as $student) {
            if (empty($student->nisn)) {
                continue;
            }

            $email = strtolower($student->nisn) . '@man2kuningan.sch.id';
            
            // Cari akun berdasarkan id_siswa
            $user = $this->userRepository->getAccountBySiswaId($student->id);
                        
            if (!$user) {
                // Jika belum punya akun, pastikan email tidak dipakai orang lain dulu
                if (!$this->userRepository->isEmailTaken($email)) {
                    $this->userRepository->createStudentAccount([
                        'name' => $student->nama,
                        'email' => $email,
                        'password' => '123456',
                        'id_siswa' => $student->id
                    ]);
                    $countNew++;
                }
            } else {
                // Jika sudah punya akun, cek apakah NISN-nya berubah sehingga email tidak cocok
                if ($user->email !== $email) {
                    // Pastikan email baru belum dipakai orang lain
                    if (!$this->userRepository->isEmailTaken($email)) {
                        $this->userRepository->updateEmail($user->id, $email);
                        $countSynced++;
                    }
                }
            }
        }

        return [
            'new' => $countNew,
            'synced' => $countSynced
        ];
    }
}
