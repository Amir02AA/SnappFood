<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;
    protected $fillable = ['count','percent','food_id'];

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
