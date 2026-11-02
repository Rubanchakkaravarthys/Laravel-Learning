<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class Student extends Model
{
     use HasFactory;

    protected $table = 'student';
    protected $guarded = [];
    protected $fillable = [
        'name',
        'file'
    ];

    public function profile(){
        return $this->hasOne(StudentProfile::class);
    }

    public function courses(){
        return $this->hasMany(Course::class);
    }

    // public function subjects(){
    //     return $this->belongsToMany(Subject::class);
    // }

}
