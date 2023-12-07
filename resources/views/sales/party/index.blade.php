@extends('layout.main')

@section('content')
    <main class="bg-blue-200 mx-auto flex min-h-screen w-full items-center justify-center text-white">
        <section class="flex w-[30rem] flex-col space-y-6">
            <div class="text-center text-4xl font-medium text-black">Food Party</div>
            <div class="w-full space-y-4">

                @foreach($parties as $party)
                    <div class="bg-gray-800 rounded-lg p-4 flex flex-row gap-5 items-center justify-between">
                        <div class="text-lg font-semibold">{{$party->food->restaurant->name}}</div>
                        <div class="text-lg font-semibold">{{$party->food->name}}</div>
                        <div class="text-lg font-semibold">{{$party->percent}}%</div>
                        <div class="text-lg font-semibold">{{$party->count}}</div>
                    </div>
                @endforeach
            {{$parties->links()}}
            </div>
            <x-paginate/>

        </section>
    </main>

@endsection
