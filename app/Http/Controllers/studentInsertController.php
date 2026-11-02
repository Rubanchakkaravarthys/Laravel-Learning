<?php

namespace App\Http\Controllers;

use App\Models\Student;

use App\Models\Subject;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class studentInsertController extends Controller
{
    // public function student_list(Request $request){
    //     // $students = DB::select('select * from student');
    //     // return view('student_list',['students'=> $students]);
    //     $students = DB::table('student')->paginate(5);

    // return view('student_list', [
    //     'students' => $students
    // ]);

    // }



    // public function insertFrom(){
    //     return view('insertForm');
    // }

    // public function insert(Request $request){

    //     $name = $request->input('student_name');

    //     // validate

    //     $request->validate([
    //         "student_name" => 'required',
    //         'file' => 'required|file',
    //     ]);

    //     $filepath = $request-> file('file')->store('students','public');

    //     DB::insert("insert into student(name,file) values(?,?)",[$name,$filepath]);
    //     // return 'Record inserted successfully!';
    //      return redirect('/student-view')->with('message','Record inserted successfully!');
    // }

    // public function edit($id){
    //     $student = DB::select('select * from student where id =?',[$id]);

    //     // return view('student_list',['student'=> $student]);

    //     return view('editStudent',['student'=>$student]);

    // }

    // public function update(Request $request , $id){

    //     // validate

    //     $request->validate([
    //         'student_name'=>'required',
    //         'file'=>'nullable|file',
    //         ]);
    //         $student = DB::select('select * from student where id =?',[$id]);
    //         if(!$student){
    //             abort(404);
    //             };
    //             $student=$student[0];
    //             $name = $request->input('student_name');
    //         if($request->hasFile('file')){
    //             if($student->file){
    //                 Storage::disk('public')->delete($student->file);

    //                 }
    //                 $filepath = $request->file('file')->store('students','public');
    //                 DB::update('update student set name=? , file=? where id =?',[$name,$filepath,$id]);
    //     }else{
    //     DB::update('update student set name =? where id =?',[$name,$id]);
    //     }
    //       return redirect('/student-view')
    //     ->with('message', 'Record updated successfully!');
    // }

    // public function delete( $id){

    // $student=DB::select('select * from student where id =?',[$id]);

    // if(!$student){
    //  abort(404);

    // }

    // $student = $student[0];

    // if($student->file){
    //     Storage::disk('public')->delete($student->file);


    // }

    //     DB::delete('delete from student where id=?',[$id]);
    //     // return "Record deleted successfully!" ;
    //     return redirect('/student-view')->with('message','Record deleted successfully!');
    // }

    // //  sort

    // public function student_sort(){
    //     return view('student_sort');
    // }

    // public function sorting(Request $request){
    //      $sort = $request->input('sort','asc');

    //      if($sort=='desc'){
    //         // $students = DB::select('select * from student order by name desc');
    //         $students = DB::table('student')->orderBy('name','desc')->paginate(5)->withQueryString();

    //      }
    //      else{
    //         //   $students = DB::select('select * from student order by name asc');
    //         $students = DB::table('student')->orderBy('name','asc')->paginate(5)->withQueryString();


    //      }

    //      return view('student_list',['students'=>$students]);
    // }


    // // search filter

    // public function student_search(){
    //     return view('student_search');
    // }

    // public function filter(Request $request){

    //     $name = $request->input('student_name');
    //     // $students = DB::select( 'select * from student where name like?', ['%' . $name . '%']);
    //     // return view('student_list',['students'=>$students]);

    //     $students = DB::table('student')->where('name','like','%'.$name.'%')->paginate(5)->withQueryString();

    //     return view('/student_list',['students'=>$students]);

    // }


    // //pagination

    // public function student_pagination(){
    //     return view('student_pagination');
    // }

    // public function pagination(Request $request){
    //        $students = DB::table('student') ->paginate(5);
    //        return view('student_list',['students'=>$students]);
    // }

    // Eloquent orm

    // route model binding => laravel automatically convert a route parameter into a eloquent model

public function student_list(Request $request)
{
    $search = trim($request->query('search', ''));

    $sort = $request->query('sort', 'asc');

    if (!in_array($sort, ['asc', 'desc'], true)) {
        $sort = 'asc';
    }

    $students = Student::with(['profile', 'courses'])
        ->when($search !== '', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })
        ->orderBy('name', $sort)
        ->paginate(5)
        ->withQueryString();

    return view('student_list', [
        'students' => $students,
        'search' => $search,
        'sort' => $sort,
    ]);
}


    public function insertFrom(){
        return view('insertForm');
    }

    public function insert(Request $request){

        $name = $request->input('student_name');

        // validate

        $request->validate([
            "student_name" => 'required',
            'file' => 'required|file',
        ]);

        $filepath = $request-> file('file')->store('students','public');

        Student::create([
            'name'=> $name,
            'file'=>$filepath,
        ]);

        // return 'Record inserted successfully!';
         return redirect('/student-view')->with('message','Record inserted successfully!');
    }


    // public function edit($id){
    //     $student = Student::findorFail($id);

    //     return view('editStudent',['student'=>$student]);
    // }

    // public function update(Request $request , $id){
    //     $request->validate([
    //         'student_name'=> 'required',
    //         'file' => 'nullable | file',
    //     ]);

    //     $student = Student::findorFail($id);

    //     $student->name = $request->input('student_name');

    //     if($request->hasFile('file')){
    //         if($student->file){
    //             Storage::disk('public')->delete($student->file);
    //         }

    //         $student->file = $request->file('file')->store('students','public');
    //     }
    //     $student->save();

    //     return redirect('/student-view')->with('message','Record update successfully!');
    // }

    // public function delete($id){

    // $student = Student::findorFail($id);

    // if($student->file){
    //     Storage::disk('public')->delete($student->file);
    // }
    // $student->delete();

    // return redirect('/student-view')->with('message','Record deleted successfully!');
    // }

    public function filter(Request $request){
        $request->validate([
            'student_name'=> 'required'
        ]);

        $name = $request->input('student_name');
        $students = Student::where('name', 'like', '%' . $name . '%')->paginate(5)->withQueryString();
        return view('student_list',['students'=>$students]);
    }


    public function sorting(Request $request)
    {
    $sort = $request->input('sort', 'asc');

    if (!in_array($sort, ['asc', 'desc'])) {
        $sort = 'asc';
    }

    $students = Student::orderBy('name', $sort)
        ->paginate(5)
        ->withQueryString();

    return view('student_list', [
        'students' => $students
    ]);
    }


    public function student_pagination(){
        return view('student_pagination');
    }

    public function pagination(Request $request){
           $students = Student::paginate(5);
           return view('student_list',['students'=>$students]);
    }


     // route model binding => laravel automatically convert a route parameter into a eloquent model
    public function edit(Student $student){
        $student->load(['profile','courses']);


        return view('editStudent',['student'=>$student]);
    }

       public function update(Request $request , Student $student){
        $request->validate([
             'student_name' => 'required',
             'file' => 'nullable|file',
             'address' => 'required',
             'city' => 'required',


        ]);



        $student->name = $request->input('student_name');

        if($request->hasFile('file')){
            if($student->file){
                Storage::disk('public')->delete($student->file);
            }

            $student->file = $request->file('file')->store('students','public');
        }
        $student->save();
        // Update or create profile
         $student->profile()->updateOrCreate(
        [],
        [
            'address' => $request->input('address'),
            'city' => $request->input('city'),
        ],

    );


        return redirect('/student-view')->with('message','Record update successfully!');
    }

    public function delete(Student $student){


    if($student->file){
        Storage::disk('public')->delete($student->file);
    }
    // Delete student profile
    if ($student->profile) {
        $student->profile->delete();
    }
    $student->delete();

    return redirect('/student-view')->with('message','Record deleted successfully!');
    }


    public function createProfile(Student $student){

    return view('createProfile',['student'=>$student]);
    }

    public function storeprofile(Request $request, Student $student)
{
    $request->validate([
        'address' => 'required',
        'city' => 'required',
    ]);

    $student->profile()->create([
        'address' => $request->input('address'),
        'city' => $request->input('city'),
    ]);

    return redirect('/student-view')
        ->with('message', 'Profile created successfully');
}

    public function courses(Student $student){

    return view('courseDetail',['student'=>$student]);

    }

    public function storeCourses(Request $request , Student $student){

    $request->validate([
        'course_name' => 'required'
    ]);

    $student->courses()->create([
        'course_name' =>$request->input('course_name')

    ]);

    return redirect('/student-view')->with('message','course created successfully!');

    }

//     public function subjects(Student $student){
//             $subjects = Subject ::all();


//     return view('subjectList',['student'=>$student,'subjects' => $subjects]);


//     }

//     public function storeSubjects(Request $request, Student $student)
// {
//     $request->validate([
//         'subject_id' => 'required|exists:subjects,id'
//     ]);

//     $student->subjects()->syncWithoutDetaching([
//         $request->subject_id
//     ]);

//     return redirect('/student-view')
//         ->with('message', 'Subject added successfully!');
// }


}
