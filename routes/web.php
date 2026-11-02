<?php
/** @var string $title */

use App\Http\Controllers\AuthController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\nameController;
use App\Http\Controllers\studentInsertController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use function Laravel\Prompts\title;

// Route::get('/', function () {
//     return view('welcome');
// });

// :: => static methods of a class

// Route::get('/', function () {
//     return "Learning Laravel ";

// });

Route::get("/",function(){
    return view('home');
});

Route::get("/about",function(){
    return view('about');

});

Route::get('/users',function(){
    // dynamic passing the data
    $title = 'Form Submission';
   return view('form', [
        'title' => $title
    ]);
});


/* magic method => (we can create a function)
 with method

 */

// Route::get('/users',function(){
//     // dynamic passing the data
//     $title = 'Form Submission';
//     $title1 = 'it is a dynamic heading';
//    return view('form') ->with('title',$title) -> with('title1',$title1);
// });

// Route::get('/users',function(){

//     return view('/users')->withTest('Magic testing we can create a own function ');
// });

Route::post('getuser-data',function(Request $request){
    // dd => dum & die
    // $request => variable
    //    dd($request -> all());   it will be return all the datas
    $name = $request->input('name');
    $email = $request->input('email');

    // return 'Name :' .$name . 'Email :' .$email;

    // redirect the page and send a success message  , -> chain
  return redirect('/users')->with("message","successfully submitted!");
});


//  router parameter with dynamic url

Route::get('test-page/{id}/{type?}',function($id,$type=null){
// return $id;
if($id == '1' && $type =='page'){
    return '<h1>This is my first Page</h1>';
}
elseif($id == 1 && $type == 'number'){
    return '<h1>This is my  number page</h1>';
}
elseif($id ==1 && $type == null){
    return '<h1>This is something</h1>';
}
}) -> name('dynamic-page');

Route::view('sample-page', 'page');

// route groups and middleware



Route::prefix('gallery')->group(function(){
    Route::get('photo',function(){
    return '<h1>This is a photo page</h1>';
});

Route::get('video',function(){
    return '<h1>This a video page</h1>';
});

});


// middleware => it check and all the function

Route::get('name/{num}',function($num){
    if($num == 1){
        return "laravel";
    }elseif($num==2){
        return "php";

    }

})->middleware('name');


//  controller =>  don't handle in routes only in controller  , ::->scope resolution operator

Route::get('login', [LoginController::class, 'login']);

Route::post('login', [LoginController::class, 'login_process']);

Route::get('forget', [LoginController::class, 'forget_password']);

Route::get('name-num/{num}', [nameController::class, 'nameNum']);


// migration => send ur information to the database

// crud operation
Route::get('student', [studentInsertController::class, 'insertFrom']);

Route::post('create', [studentInsertController::class, 'insert']);

Route::get('student-view',[studentInsertController::class,'student_list']);

// Route::get("/edit/{id}", [studentInsertController::class,'edit']);

// Route::post('/edit/{id}',[studentInsertController::class,'update']);

// Route::get('/delete/{id}',[studentInsertController::class,'delete']);


// Sorting
Route::get('/student-sort', [studentInsertController::class, 'sorting']);
Route::get('/sort', [studentInsertController::class, 'sorting']);


// search filter
Route::get('/student-search',[studentInsertController::class,'student_search']);

Route::get('/student-filter',[studentInsertController::class,'filter']);


// pagination
Route::get('/student-pagination',[studentInsertController::class,'student_pagination']);

Route::get('/pagination', [studentInsertController::class,'pagination']);


// Authentication & Authorization
Route::get('register',[AuthController::class,'registerForm']);

Route::post('register',[AuthController::class,'register']);

Route::get('login',[AuthController::class,'loginForm']);

Route::post('login', [AuthController::class, 'login']);

Route::get('/dashboard', function () {
    return view("dashboard");
})->middleware('auth');

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/admin', function () {
    return view('admin');
})->middleware(['auth','role:admin']);

Route::get('/manager', function () {
    return view('manager');
})->middleware(['auth','role:manager']);


// route model binding

// laravel application that converts a route parameter into eloquent model.

Route::get("/edit/{student}", [studentInsertController::class,'edit']);

Route::post('/edit/{student}',[studentInsertController::class,'update']);

Route::get('/delete/{student}',[studentInsertController::class,'delete']);

Route::get('/profile-create/{student}',[studentInsertController::class,'createProfile']);

Route::post('/profile-create/{student}',[studentInsertController::class,'storeprofile']);

Route::get('/course/{student}',[studentInsertController::class,'courses']);

Route::post('/course/{student}',[studentInsertController::class,'storeCourses'] );

// Route::get('/subject/{student}',[studentInsertController::class,'subjects']);

// Route::post('/subject/{student}',[studentInsertController::class,'storeSubjects']);
