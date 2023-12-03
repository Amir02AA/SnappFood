<?php

namespace App\Models;

use App\Classes\CommentsStatus;
use App\Classes\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'user_id',
        'order_id',
        'content',
        'score',
        'status',
        'reply_to'
    ];
    protected $casts = [
        'status' => CommentsStatus::class
    ];

    protected function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function food()
    {
        return $this->belongsTo(Food::class);
    }

    protected function replied()
    {
        return $this->hasOne(Comment::class,'reply_to');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
