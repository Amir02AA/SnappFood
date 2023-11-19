@extends('layout.main')

@section('content')
    <!-- Food Add Component with Custom Styles -->
    <main class="bg-gray-900 mx-auto flex min-h-screen w-full items-center justify-center text-white">
        <section class="flex w-[30rem] flex-col space-y-6">
            <div class="text-center text-4xl font-medium text-white">Profile</div>

            <!-- Form to add food -->
            <form action="{{route('sales.profile.store')}}" method="post" class="space-y-6">
                @csrf
                <div class="w-full border-b-2 text-lg duration-300 focus-within:border-indigo-500">
                    <input type="text" name="name" placeholder="Name" class="w-full border-none bg-transparent outline-none placeholder-italic focus:outline-none text-white">
                </div>
                <div class="w-full border-b-2 text-lg duration-300 focus-within:border-indigo-500">
                    <input type="text" name="phone" placeholder="Phone" class="w-full border-none bg-transparent outline-none placeholder-italic focus:outline-none text-white">
                </div>
                <div class="w-full text-lg duration-300">
                    <div class="w-full border-b-2 text-lg duration-300 focus-within:border-indigo-500 mb-2">
                        <textarea type="text" name="address" placeholder="Address" class="w-full border-none bg-transparent outline-none placeholder-italic focus:outline-none text-white"></textarea>
                    </div>
                    <div class="flex gap-1.5 w-full  text-lg duration-300 ">
                        <input type="text" name="lang" placeholder="Langitude" class="w-full border-b-2 focus-within:border-indigo-500 bg-transparent outline-none placeholder-italic focus:outline-none text-white"></input>
                        <input type="text" name="long" placeholder="Longitude" class="w-full border-b-2 focus-within:border-indigo-500 bg-transparent outline-none placeholder-italic focus:outline-none text-white">
                    </div>

                </div>
                <div class="w-full border-b-2 text-lg duration-300 focus-within:border-indigo-500">
                    <input type="text" name="account" placeholder="Account Number" class="w-full border-none bg-transparent outline-none placeholder-italic focus:outline-none text-white">
                </div>
                <div>
                    @foreach($tiers as $tier)
                        <div>
                            <label for="type{{$tier->id}}">{{$tier->name}}</label>
                            <input type="checkbox" name="tiers[]" id="type{{$tier->id}}" value="{{$tier->id}}">
                        </div>
                    @endforeach
                </div>
                <div class="w-full">
                    <button type="submit" class="w-full transform rounded-sm bg-pink-600 py-2 font-bold duration-300 hover:bg-pink-400"> Add Food </button>
                </div>
            </form>
        </section>
    </main>

@endsection
