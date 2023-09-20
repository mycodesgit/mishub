<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id';
    protected $table = 'students';

    protected $fillable = [
        'stud_id',
        'fullname',
        'password',
        'studlist_id',
        'vc_id',
    ];
}
