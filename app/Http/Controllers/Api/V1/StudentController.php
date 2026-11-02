<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    public function index(Request $request)
    {
       try {

         Log::info('Student list API requested');

        $students = Student::with(['profile', 'courses'])
            ->withCount('courses')
            ->paginate(5);

         Log::info('Student list retrieved successfully', [
            'total_students' => $students->total(),
            'current_page' => $students->currentPage(),
        ]);


        return StudentResource::collection($students);
       } catch (\Throwable $e) {

       Log::error('Failed to retrieve student list',[
        'exception' => get_class($e),
        'message'   => $e->getMessage()
       ]);

       throw $e;

       }
    }
}
