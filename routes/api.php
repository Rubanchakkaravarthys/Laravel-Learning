
<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\StudentController as V1StudentController;
use App\Http\Controllers\Api\V2\StudentController as V2StudentController;

// Public route: log in to receive a token
Route::post('/login', [ApiAuthController::class, 'login']);
Route::post('/register', [ApiAuthController::class, 'register']);
// Routes requiring a valid Sanctum token
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [ApiAuthController::class, 'logout']);

      // Logout from all devices
    Route::post('/logout-all', [ApiAuthController::class,'logoutAll' ]);

    Route::get('/profile', function (Request $request) {
        return response()->json([
            'user' => $request->user()->only([
                'id',
                'name',
                'email',
                'role',
            ]),
        ]);
    });

    // READ: list students and view one student
    // throttle => rate limitation for ur api 
   Route::get('/students', [StudentController::class, 'index'])
    ->middleware([
        'abilities:students:read',
        'throttle:api-custom',
    ]);

    // container & provider   
    // container=> create a dependency injection for your application 
    // provider => register and configure a dependency 

    Route::get('/students/count', [ StudentController::class, 'totalStudents',])
        ->middleware('abilities:students:read');


    

    Route::get('/students/{student}', [StudentController::class, 'show'])
        ->middleware('abilities:students:read');

    // CREATE: add a student
    Route::post('/students', [StudentController::class, 'store'])
        ->middleware('abilities:students:create');

    // UPDATE: edit a student
    Route::put('/students/{student}', [StudentController::class, 'update'])
        ->middleware('abilities:students:update');

    // DELETE: remove a student
    Route::delete('/students/{student}', [StudentController::class, 'destroy'])
        ->middleware('abilities:students:delete');

Route::post('/students-with-course',[StudentController::class, 'createStudentWithCourse']);

Route::prefix('v1')->group(function(){
    Route::get('/students',[V1StudentController::class,'index'])
        ->middleware('abilities:students:read');
});

Route::prefix('v2')->group(function(){
    Route::get('/students',[V2StudentController::class,'index'])
        ->middleware('abilities:students:read');
});

});
