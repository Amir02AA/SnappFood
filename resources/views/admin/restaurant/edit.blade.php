<?php
@extends('layout.main')

@section('content')
    <!-- Food Add Component with Custom Styles -->
    <main class="mx-auto flex min-h-screen w-full items-center justify-center text-white">
        <section class="flex w-[30rem] flex-col space-y-6">
            <div class="text-center text-4xl font-medium text-white">Add Food</div>

            <!-- Form to add food -->
            <form action="process_food.php" method="post" class="space-y-6">
                <div class="w-full border-b-2 text-lg duration-300 focus-within:border-indigo-500">
                    <input type="text" name="name" placeholder="Name" class="w-full border-none bg-transparent outline-none placeholder-italic focus:outline-none text-white">
                </div>
                <div class="w-full border-b-2 text-lg duration-300 focus-within:border-indigo-500">
                    <input type="text" name="material" placeholder="Material" class="w-full border-none bg-transparent outline-none placeholder-italic focus:outline-none text-white">
                </div>
                <div class="w-full border-b-2 text-lg duration-300 focus-within:border-indigo-500">
                    <input type="text" name="price" placeholder="Price" class="w-full border-none bg-transparent outline-none placeholder-italic focus:outline-none text-white">
                </div>
                <div class="w-full border-b-2 text-lg duration-300 focus-within:border-indigo-500">
                    <input type="text" name="food_tier_id" placeholder="Food Tier ID" class="w-full border-none bg-transparent outline-none placeholder-italic focus:outline-none text-white">
                </div>
                <div class="w-full border-b-2 text-lg duration-300 focus-within:border-indigo-500">
                    <input type="text" name="restaurant_id" placeholder="Restaurant ID" class="w-full border-none bg-transparent outline-none placeholder-italic focus:outline-none text-white">
                </div>
                <button type="submit" class="bg-blue-500 py-2 font-bold duration-300 hover:bg-blue-400 text-white">Add Food</button>
            </form>
        </section>
    </main>

@endsection
