<?php

namespace App\Classes;

use App\Models\Food;

class CommentHelper
{
    public static function getCommentsByFoodId(int $foodId)
    {
        return Food::find($foodId)->orders()->has('comment')->get()->pluck('comment');
    }
}
