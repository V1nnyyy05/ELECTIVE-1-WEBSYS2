<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'student_number',
        'name',
        'program',
        'major',
        'year_level',
        'photo_path'
    ];
}
