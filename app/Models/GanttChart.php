<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GanttChart extends Model
{
    use HasFactory;

    protected $table = 'ganttChart';

    protected $fillable = [
        'task',
        'descrip',
        'start_date',
        'end_date',
        'duration',
        'percent_completed',
        'user_id',
        'status',
        'remember_token',
    ];
}
