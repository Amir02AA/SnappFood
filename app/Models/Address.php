<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory ,SoftDeletes;

    protected $fillable = [
        'lang', 'long', 'name', 'vahed', 'address', 'is_selected'
    ];



    public function addressable()
    {
        return $this->morphTo();
    }
}
