@extends('layout.main')

@section('content')
    <main class="bg-gray-900 mx-auto flex min-h-screen w-full items-center justify-center text-white">
        <section class="flex w-[30rem] flex-col space-y-6">
            <div class="text-center text-4xl font-medium text-white">Edit Food Tier</div>

            <form action="{{route('admin.food.update',['food'=>$food])}}" method="post" class="space-y-6">
                @csrf
                @method('PATCH')
                <div class="w-full border-b-2 text-lg duration-300 focus-within:border-indigo-500">
                    <input type="text" name="name" placeholder="Name" value="{{$food->name}}"
                           class="w-full border-none bg-transparent outline-none placeholder-italic focus:outline-none text-white">
                </div>
                <div class="w-full">
                    <button type="submit"
                            class="w-full transform rounded-sm bg-pink-600 py-2 font-bold duration-300 hover:bg-pink-400">
                        Update Food Tier
                    </button>
                </div>
            </form>
        </section>
    </main>

@endsection
