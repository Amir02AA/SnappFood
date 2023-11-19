<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OffFood extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'percent', 'food_id'
    ];

    protected function food()
    {
        return $this->belongsTo(Food::class);
    }
}
