@extends('layout.main')

@section('content')
    <main class="min-h-screen bg-gray-900 text-white flex items-center justify-center">
        <section class="w-full h-screen flex items-center justify-center">
            <div class="bg-gray-800 p-8 rounded-lg text-center">
                <div class="text-4xl font-semibold mb-4">{{$food->name}}</div>

                <a href="{{route('admin.food.edit',$food)}}" class="flex items-center justify-end text-indigo-500 hover:text-indigo-400 mt-4">
                    Edit
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </section>
    </main>
@endsection
