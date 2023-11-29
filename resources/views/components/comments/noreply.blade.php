<div class="bg-gray-800 rounded-lg p-4 flex flex-col gap-2">
    <div>
        <h3 class="text-green-500">Accepted</h3>
    </div>
    <div class="text-lg font-bold">
        <span class="text-cyan-400">by: </span> {{$comment->user->name}}
    </div>
    <p class="font-semibold">
        <span class="text-cyan-400">comment: </span> {{$comment->content}}
    </p>
    <p class="text-amber-600 font-semibold">
        <span class="text-cyan-400">score: </span>{{$comment->score}} / 5
    </p>
    <div class="flex gap-4 w-full mt-3">
        <form method="post" action="{{route('sales.comment.reply',$comment)}}"
            class="flex gap-2">
            @csrf
            <textarea name="content" class="text-black p-2 rounded-xl" placeholder="reply to comment"></textarea>
            <button class="button bg-blue-400 text-black rounded-2xl p-3" type="submit">reply</button>
        </form>
    </div>
</div>
