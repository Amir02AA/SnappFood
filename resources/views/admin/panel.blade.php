@extends('layout.main')

@section('content')

    <main class="min-h-screen bg-gray-900 text-white">
        <section class="flex">

            <nav class="bg-gray-800 h-screen w-64 p-4 flex flex-col space-y-4">

                <div class="text-2xl font-semibold text-white">Admin Panel</div>


                <a href="{{route('admin.food.index')}}" class="text-white hover:text-indigo-500">food Categories</a>
                <a href="{{route('admin.restaurants.index')}}" class="text-white hover:text-indigo-500">Restaurant Categories</a>
                <a href="{{route('admin.off.index')}}" class="text-white hover:text-indigo-500">Offs</a>
                <a href="{{route('admin.comments.index')}}" class="text-white hover:text-indigo-500">Delete Comment Requests</a>
                <a href="{{route('admin.carts.archive')}}" class="text-white hover:text-indigo-500">Archive</a>


                <form method="post" action={{route('logout')}}>
                    @csrf
                    <button type="submit" class="text-red-400 hover:text-indigo-400 mt-auto">Logout</button>
                </form>
            </nav>


            <div class="flex-grow p-4">

            </div>
        </section>
    </main>
@endsection
