@extends('layout.main')

@section('content')
    <main class="bg-blue-200 mx-auto flex min-h-screen w-full items-center justify-center text-white">
        <a href="{{route('admin.panel')}}" class="fixed top-4 left-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
                <path fill="#1f2937" d="M10 20v-6h4v6h5v-8h3L12 3L2 12h3v8z"/>
            </svg>
        </a>
        <section class="flex w-[30rem] flex-col space-y-6">
            <div class="text-center text-4xl font-medium text-black">Comments Delete Requests</div>
            <div class="w-full space-y-4">

                @foreach($comments as $comment)
                    <div class="bg-blue-900">
                        <p>{{$comment->content}}</p>
                        <form method="post" action="{{route('admin.comments.destroy',$comment)}}">
                            @csrf @method('delete')
                            <button type="submit">delete comment</button>
                        </form>
                        <form method="post" action="{{route('admin.comments.cancel',$comment)}}">
                            @csrf
                            <button type="submit">cancel request</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
@endsection
