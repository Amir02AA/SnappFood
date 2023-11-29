<div class="bg-gray-800 rounded-lg p-6 flex flex-col gap-2">
    <div>
        <h3 class="text-indigo-400">New Comment</h3>
    </div>
    <div class="flex flex-col justify-between">
        <div class="text-lg font-bold">
            <span class="text-cyan-400">by: </span> {{$comment->user->name}}
        </div>
        <p class="font-semibold">
            <span class="text-cyan-400">comment: </span> {{$comment->content}}
        </p>
        <p class="text-amber-600 font-semibold">
            <span class="text-cyan-400">score: </span>{{$comment->score}} / 5
        </p>
    </div>
    <div class="flex gap-3">
        <form method="post" action="{{route('sales.comment.delete',$comment)}}">
            @csrf
            <button class="button bg-red-500 text-white font-bold px-2 py-1 rounded-3xl" type="submit">delete</button>
        </form>
        <form method="post" action="{{route('sales.comment.accept',$comment)}}">
            @csrf
            <button class="button bg-green-500 text-white font-bold px-2 py-1 rounded-3xl" type="submit">accept</button>
        </form>
    </div>
</div>
