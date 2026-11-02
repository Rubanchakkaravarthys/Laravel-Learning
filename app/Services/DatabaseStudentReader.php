<?php

namespace App\Services;

use App\Models\Student;

class DatabaseStudentReader implements StudentReader
{
    public function getTotalStudents(): int
    {
        return Student::count();
    }
}
