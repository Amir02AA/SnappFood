<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['user_id', 'restaurant_id', 'paid_date', 'status', 'address_id', 'off_code_id'];
    public function food(): BelongsToMany
    {
        return $this->belongsToMany(Food::class)->withPivot('count');
    }
}
