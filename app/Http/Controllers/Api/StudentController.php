<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        // $version = Cache::remember(
        //     'students:cache_version',
        //     now()->addDays(30),
        //     fn () => 1
        // );

        // $search = (string) $request->query('search', '');
        // $page = max(1, (int) $request->query('page', 1));

        // $cacheKey = 'students:index:v' . $version
        //     . ':search:' . md5($search)
        //     . ':page:' . $page;

        // $students = Cache::remember(
        //     $cacheKey,
        //     now()->addMinutes(5),
        //     function () use ($request) {
        //         return Student::with(['profile', 'courses'])
        //             ->withCount('courses')
        //             ->when(
        //                 $request->query('search'),
        //                 function ($query, $search) {
        //                     $query->where('name', 'like', "%{$search}%");
        //                 }
        //             )
        //             ->paginate(5)
        //             ->withQueryString();
        //     }
        // );

        $students = Student::with(['profile', 'courses'])
        ->withCount('courses')
        ->when(
            $request->query('search'),
            function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            }
        )
        ->paginate(5)
        ->withQueryString();

        return StudentResource::collection($students);
    }

    public function store(StoreStudentRequest $request)
    {
        $validated = $request->validated();

        $filepath = $request->file('file')
            ->store('students', 'public');

        $student = Student::create([
            'name' => $validated['name'],
            'file' => $filepath,
        ]);

        $this->invalidateStudentsCache();

        return (new StudentResource($student))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Student $student)
    {
        $student->load(['profile', 'courses']);
        $student->loadCount('courses');

        return new StudentResource($student);
    }

    public function update(
        UpdateStudentRequest $request,
        Student $student
    ) {
        $validated = $request->validated();

        $student->name = $validated['name'];

        if ($request->hasFile('file')) {
            if ($student->file) {
                Storage::disk('public')->delete($student->file);
            }

            $student->file = $request->file('file')
                ->store('students', 'public');
        }

        $student->save();
        $this->invalidateStudentsCache();

        return new StudentResource($student);
    }

    public function destroy(Student $student)
    {
        $this->authorize('delete', $student);

        if ($student->file) {
            Storage::disk('public')->delete($student->file);
        }

        if ($student->profile) {
            $student->profile->delete();
        }

        $student->delete();
        $this->invalidateStudentsCache();

        return response()->json([
            'message' => 'Student deleted successfully',
        ], 200);
    }

    public function createStudentWithCourse(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'course_name' => 'required|string|max:255',
        ]);

        $student = DB::transaction(function () use ($validated) {
            $student = Student::create([
                'name' => $validated['name'],
                'file' => null,
            ]);

            $student->courses()->create([
                'course_name' => $validated['course_name'],
            ]);

            return $student;
        });

        $this->invalidateStudentsCache();

        return response()->json([
            'message' => 'Student and course created successfully',
            'data' => $student->load('courses'),
        ], 201);
    }

    public function totalStudents(
       StudentReader $studentReader
    ) {
        return response()->json([
            'total_students' => $studentReader->getTotalStudents(),
        ]);
    }

    private function invalidateStudentsCache(): void
    {
        Cache::add(
            'students:cache_version',
            1,
            now()->addDays(30)
        );

        Cache::increment('students:cache_version');
    }
}
