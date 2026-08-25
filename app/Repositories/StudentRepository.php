<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository
{
    /**
     * Get all active students
     */
    public function getActiveStudents()
    {
        return Student::whereIn('status', ['A', 'Aktif'])->get();
    }

    /**
     * Update student profile data
     */
    public function updateProfile($studentId, array $data)
    {
        $student = Student::find($studentId);
        if ($student) {
            $student->update($data);
            return $student;
        }
        return null;
    }
}
