<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'student_id' =>Student::factory(),
        'course_name' => fake()->randomElement([
            'HTML',
            'CSS',
            'JavaScript',
            'React',
            'TypeScript',
            'Tailwind CSS',
            'Bootstrap',
            'Node.js',
            'php',
            'laravel',
            'stylex',
            'angular'
        ]),
        ];
    }
}
