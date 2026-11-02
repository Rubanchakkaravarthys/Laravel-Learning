<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\student;
use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(10)->create();

        $students = student::factory()->count(10)->create();

        foreach ($students as $student) {
            StudentProfile::factory()
                ->create(['student_id' => $student->id]);

            Course::factory()
                ->count(3)
                ->create(['student_id' => $student->id]);
        }
    }
}
