<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
     use HasFactory;

    protected $table = 'student_profiles';

    protected $fillable = [
        'student_id',
        'address',
        'city'
    ];

    public function student(){

    return $this->belongsTo(student::class);
    }
}
