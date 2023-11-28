<div class="bg-gray-800 rounded-lg p-4">
    <div>
        <h3 class="text-indigo-400">New Comment</h3>
    </div>
    <div class="flex flex-col justify-between">
        <div class="text-lg font-semibold">{{$comment->user->name}}</div>
        <p class="text-lg font-semibold">{{$comment->content}}</p>
        <p class="text-cyan-400 font-semibold">{{$comment->score}} / 5</p>
    </div>
    <div>
        <form method="post" action="{{route('sales.comment.delete',$comment)}}">
            @csrf
            <button type="submit">delete</button>
        </form>
        <form method="post" action="{{route('sales.comment.accept',$comment)}}">
            @csrf
            <button type="submit">accept</button>
        </form>
    </div>
</div>
