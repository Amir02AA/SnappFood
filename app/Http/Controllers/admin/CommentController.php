<?php

namespace App\Http\Controllers\admin;

use App\Classes\CommentsStatus;
use App\Classes\PaginateHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(PaginateRequest $request)
    {
        $paginate = PaginateHelper::getPaginateNumber($request->get('paginate'));
        $comments = Comment::query()->where('status',CommentsStatus::Delete)
            ->orderBy('created_at','desc')->paginate($paginate);
        return view('admin.comment.index',compact('comments'));
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comment.index');
    }

    public function cancel(Comment $comment)
    {
        $comment->update(['status' => CommentsStatus::NoReply]);
        return redirect()->route('admin.comment.index');
    }
}
