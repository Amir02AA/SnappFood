<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Party extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = [
        'final_percent'
    ];
    protected $fillable = ['count', 'percent', 'food_id'];

    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    protected function finalPercent(): Attribute
    {
        return Attribute::make(
            get: fn() =>($this->percent * ($this->count !== 0))
        );
    }
}
