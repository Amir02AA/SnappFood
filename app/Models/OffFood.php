<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffFood extends Model
{
    use HasFactory;

    protected function food()
    {
        return $this->belongsTo(Food::class);
    }
}
