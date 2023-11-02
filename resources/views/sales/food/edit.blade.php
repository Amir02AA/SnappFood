
@extends('layout.main')

@section('content')
    <!-- Food Add Component with Custom Styles -->
    <main class="bg-gray-900 mx-auto flex min-h-screen w-full items-center justify-center text-white">
        <a href="{{route('sales.dashboard')}}" class="fixed top-4 left-4" > <!-- Home -->
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="#db2777" d="M10 20v-6h4v6h5v-8h3L12 3L2 12h3v8z"/></svg>
        </a>
        <section class="flex w-[30rem] flex-col space-y-6">
            <div class="text-center text-4xl font-medium text-white">Update Food</div>

            <!-- Form to add food -->
            <form action="{{route('sales.food.update',$food)}}" method="post" class="space-y-6">
                @csrf
                @method('patch')
                <input type="number" name="id" hidden value="{{$food->id}}">
                <div class="w-full border-b-2 text-lg duration-300 focus-within:border-indigo-500">
                    <input type="text" value="{{$food->name}}" name="name" placeholder="Name" class="w-full border-none bg-transparent outline-none placeholder-italic focus:outline-none text-white">
                </div>
                @error('name') {{$message}} @enderror

                <div class="w-full border-b-2 text-lg duration-300 focus-within:border-indigo-500">
                    <input type="text" value="{{$food->materials}}" name="materials" placeholder="Material" class="w-full border-none bg-transparent outline-none placeholder-italic focus:outline-none text-white">
                </div>
                @error('materials') {{$message}} @enderror

                <div class="w-full border-b-2 text-lg duration-300 focus-within:border-indigo-500">
                    <input type="text" value="{{$food->price}}" name="price" placeholder="Price" class="w-full border-none bg-transparent outline-none placeholder-italic focus:outline-none text-white">
                </div>
                @error('price') {{$message}} @enderror

                <div class="w-full border-b-2 text-lg duration-300 focus-within:border-indigo-500">
                    <input type="text" value="{{$food->food_tier_id}}" name="food_tier_id" placeholder="Food Tier ID" class="w-full border-none bg-transparent outline-none placeholder-italic focus:outline-none text-white">
                </div>
                @error('food_tier_id') {{$message}} @enderror

                <div class="w-full">
                    <button type="submit" class="w-full transform rounded-sm bg-pink-600 py-2 font-bold duration-300 hover:bg-pink-400"> Update Food </button>
                </div>
            </form>
        </section>
    </main>

@endsection
