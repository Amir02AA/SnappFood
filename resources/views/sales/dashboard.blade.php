@extends('layout.main')

@section('content')
    <main class="min-h-screen bg-gray-900 text-white">
        <section class="flex">
            <!-- Navbar -->
            <nav class="bg-gray-800 h-screen w-64 p-4 flex flex-col space-y-4">

                <div class="text-2xl font-semibold text-white">SalesMan Dashboard</div>

                <a href="{{route('sales.settings')}}" class="text-white hover:text-indigo-500">Restaurant Settings</a>
                <a href="{{route('sales.food.index')}}" class="text-white hover:text-indigo-500">Food</a>
                <p class="text-white hover:text-indigo-500">Restaurant : {{$user->restaurant->name}}</p>


                <form method="post" action="{{route('logout')}}">
                    @csrf
                    <button type="submit" class="text-indigo-500 hover:text-indigo-400 mt-auto">Logout</button>
                </form>
            </nav>


            <div class="flex-grow p-4">
                <h1>Welcome {{$user->name}}</h1>

            </div>
        </section>
    </main>
@endsection
