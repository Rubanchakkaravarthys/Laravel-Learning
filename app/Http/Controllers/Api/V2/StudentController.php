<?php
namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $students = Student::withCount('courses')->paginate(5);

        return response()->json([
            'version' => 'v2',
            'total_students' => Student::count(),
            'data' => $students->getCollection()->map(
                function ($student) {
                    return [
                        'id' => $student->id,
                        'name' => $student->name,
                        'courses_count' => $student->courses_count,
                    ];
                }
            )->values(),
            'pagination' => [
                'current_page' => $students->currentPage(),
                'last_page' => $students->lastPage(),
                'per_page' => $students->perPage(),
            ],
        ]);
    }
}
