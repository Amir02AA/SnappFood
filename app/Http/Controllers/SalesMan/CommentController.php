<?php

namespace App\Http\Controllers\salesman;

use App\Classes\CommentHelper;
use App\Classes\CommentsStatus;
use App\Http\Controllers\Controller;

use App\Http\Requests\FilterCommentsRequest;
use App\Http\Requests\StoreReplyRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Arg;

class CommentController extends Controller
{
    public function index(FilterCommentsRequest $request)
    {
        $foods = Auth::user()->restaurant->food;
        $comments = Auth::user()->restaurant->comments();
        if ($request->validated('food_id')) {
            $this->authorize('viewFiltered', [Comment::class, $request->validated('food_id')]);
            $comments = CommentHelper::getCommentsByFoodId($request->validated('food_id'));
        }
        return view('sales.comments.index', compact('comments', 'foods'));
    }

    public function reply(StoreReplyRequest $request, Comment $comment)
    {
        $this->authorize('changeStatus', [
            Comment::class, $comment
        ]);
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $validated['reply_to'] = $comment->id;
        Comment::create($validated);
        $comment->update(['status' => CommentsStatus::Replied]);
        return redirect()->route('sales.comment.index');
    }

    public function accept(Comment $comment)
    {
        $this->authorize('changeStatus', [
            Comment::class, $comment
        ]);
        $comment->update(['status' => CommentsStatus::NoReply]);
        return redirect()->route('sales.comment.index');

    }

    public function deleteRequest(Comment $comment)
    {
        $this->authorize('changeStatus', [
            Comment::class, $comment
        ]);
        $comment->update(['status' => CommentsStatus::Delete]);
        return redirect()->route('sales.comment.index');
    }
}
