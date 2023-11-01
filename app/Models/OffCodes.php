<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffCodes extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['percent' , 'code'];
}
