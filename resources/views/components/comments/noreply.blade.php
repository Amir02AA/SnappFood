<div class="bg-gray-800 rounded-lg p-4">
    <div>
        <h3 class="text-green-500">Accepted</h3>
    </div>
    <div class="flex flex-col justify-between">
        <div class="text-lg font-semibold">{{$comment->user->name}}</div>
        <p class="text-lg font-semibold">{{$comment->content}}</p>
        <p class="text-cyan-400 font-semibold">{{$comment->score}} / 5</p>
    </div>
    <div class="flex gap-4 w-full">
        <form method="post" action="{{route('sales.comment.reply',$comment)}}">
            @csrf
            <textarea name="content" class="text-black" placeholder="reply to comment"></textarea>
            <button class="button bg-blue-400 text-black rounded p-3" type="submit">reply</button>
        </form>
    </div>
</div>
