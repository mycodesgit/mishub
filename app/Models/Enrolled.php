<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrolled extends Model
{
    use HasFactory;

    protected $table = 'studentslist';

    protected $fillable = [
        'lname',
        'fname',
        'mname',
        'username',
        'password',
        'campus_id',
        'role',
        'course_id',
        'stud_id'
    ];
}
