<?php

namespace App\Http\Controllers\salesman;

use App\Classes\CommentHelper;
use App\Http\Controllers\Controller;

use App\Http\Requests\FilterCommentsRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Arg;

class CommentController extends Controller
{
    public function index(FilterCommentsRequest $request)
    {
        $foods = Auth::user()->restaurant->food;
        $comments = Auth::user()->restaurant->comments()->get();

        if ($request->validated('food_id')){
            $comments = CommentHelper::getCommentsByFoodId($request->validated('food_id'));
        }

        return view('sales.comments.index',compact('comments','foods'));
    }
}
