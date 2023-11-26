<div class="bg-gray-800 rounded-lg p-4">
    <div>
        <h3 class="text-red-500">Requested for deleting</h3>
    </div>
    <div class="flex flex-col justify-between">
        <div class="text-lg font-semibold">{{$comment->user->name}}</div>
        <p class="text-lg font-semibold">{{$comment->content}}</p>
        <p class="text-cyan-400 font-semibold">{{$comment->score}} / 5</p>
    </div>
</div>
