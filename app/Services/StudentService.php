<?php
namespace App\Services;

use App\Models\Student;

class StudentService
{
    public function getAllStudents()
    {
        return Student::with(['profile', 'courses'])
            ->withCount('courses')
            ->paginate(5);
    }
}

