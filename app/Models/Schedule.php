<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'day','start_time',
        'end_time','restaurant_id'
    ];
}
