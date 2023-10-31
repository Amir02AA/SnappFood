<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodTier extends Model
{
    use HasFactory;

    protected function food()
    {
        return $this->hasMany(Food::class);
    }
}
