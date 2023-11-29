<div class="bg-gray-800 rounded-lg p-4 flex flex-col gap-2 w-80 h-52">
    <div>
        <h3 class="text-green-500">Accepted and replied</h3>
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
    <div>
        <p>{{$comment->replied->content}}</p>
    </div>
</div>
