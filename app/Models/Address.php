<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'x' , 'y' , 'vahed' , 'address','user_id','is_selected'
    ];
    protected function user()
    {
        return $this->belongsTo(User::class);
    }

}
