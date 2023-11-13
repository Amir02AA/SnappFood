
@extends('layout.main')

@section('content')
    <!-- Food Add Component with Custom Styles -->
    <main class="bg-gray-900 mx-auto flex min-h-screen w-full items-center justify-center text-white">
        <a href="{{route('sales.dashboard')}}" class="fixed top-3 left-4" > <!-- Home -->
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="#db2777" d="M10 20v-6h4v6h5v-8h3L12 3L2 12h3v8z"/></svg>
        </a>
        <a href="{{route('sales.food.index')}}" class="fixed top-12 left-4" > <!-- index -->
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 512 512"><path fill="none" stroke="#db2777" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M160 144h288M160 256h288M160 368h288"/><circle cx="80" cy="144" r="16" fill="none" stroke="#db2777" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><circle cx="80" cy="256" r="16" fill="none" stroke="#db2777" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><circle cx="80" cy="368" r="16" fill="none" stroke="#db2777" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
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
                    <select class="js-example-basic-multiple" name="materials[]" multiple="multiple" id="mySelect2">
                        @foreach($materials as $material)
                            <option value="{{$material->id}}">{{$material->name}}</option>
                        @endforeach
                    </select>
                </div>
                @error('materials') {{$message}} @enderror

                <div class="w-full border-b-2 text-lg duration-300 focus-within:border-indigo-500">
                    <input type="text" value="{{$food->price}}" name="price" placeholder="Price" class="w-full border-none bg-transparent outline-none placeholder-italic focus:outline-none text-white">
                </div>
                @error('price') {{$message}} @enderror

                <div class="w-full  text-lg duration-300 focus-within:border-indigo-500">
                    <select id="countries" name="food_tier_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach($tiers as $tier)
                            <option value="{{$tier->id}}" @if($tier->id == $food->food_tier_id) selected="selected" @endif>{{$tier->name}}</option>
                        @endforeach
                    </select>
                </div>
                @error('food_tier_id') {{$message}} @enderror
                <div class="flex flex-row w-full border-b-2 text-lg duration-300 focus-within:border-indigo-500">
                    <input type="text" value="{{$food->off?->percent}}" name="percent" placeholder="Off percent" class="w-full border-none bg-transparent outline-none placeholder-italic focus:outline-none text-white">
                    <a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="#9f2415" d="m20.749 12l1.104-1.908a1 1 0 0 0-.365-1.366l-1.91-1.104v-2.2a1 1 0 0 0-1-1h-2.199l-1.103-1.909a1.008 1.008 0 0 0-.607-.466a.993.993 0 0 0-.759.1L12 3.251l-1.91-1.105a1 1 0 0 0-1.366.366L7.62 4.422H5.421a1 1 0 0 0-1 1v2.199l-1.91 1.104a.998.998 0 0 0-.365 1.367L3.25 12l-1.104 1.908a1.004 1.004 0 0 0 .364 1.367l1.91 1.104v2.199a1 1 0 0 0 1 1h2.2l1.104 1.91a1.01 1.01 0 0 0 .866.5c.174 0 .347-.046.501-.135l1.908-1.104l1.91 1.104a1.001 1.001 0 0 0 1.366-.365l1.103-1.91h2.199a1 1 0 0 0 1-1v-2.199l1.91-1.104a1 1 0 0 0 .365-1.367L20.749 12zM9.499 6.99a1.5 1.5 0 1 1-.001 3.001a1.5 1.5 0 0 1 .001-3.001zm.3 9.6l-1.6-1.199l6-8l1.6 1.199l-6 8zm4.7.4a1.5 1.5 0 1 1 .001-3.001a1.5 1.5 0 0 1-.001 3.001z"/></svg>
                    </a>
                </div>
                @error('percent')
                {{$message}}
                @enderror
                <div class="w-full">
                    <button type="submit" class="w-full transform rounded-sm bg-pink-600 py-2 font-bold duration-300 hover:bg-pink-400"> Update Food </button>
                </div>
            </form>
        </section>
    </main>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                tags: true
            });
        });
    </script>
@endsection
