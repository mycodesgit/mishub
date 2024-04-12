<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daily extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'accomplishment';

    protected $fillable = [
        'task',
        'no_accom',
        'user_id',
        'remember_token',
        'created_at',
    ];
}
