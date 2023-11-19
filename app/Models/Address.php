<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'lang', 'long', 'name', 'vahed', 'address', 'is_selected'
    ];

    protected function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addressable()
    {
        return $this->morphTo();
    }
}
