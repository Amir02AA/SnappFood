@extends('layout.main')

@section('content')
    <!-- Restaurant Categories Page -->
    <main class="bg-blue-200 mx-auto flex min-h-screen w-full items-center justify-center text-white">
        <section class="flex w-[30rem] flex-col space-y-6">
            <div class="text-center text-4xl font-medium">Restaurant Categories</div>

            <!-- Restaurant Category Cards -->
            <div class="w-full space-y-4">
                <!-- Restaurant Category Card 1 -->
                <div class="bg-gray-800 rounded-lg p-4 flex items-center justify-between">
                    <div class="text-lg font-semibold">Category 1</div>
                    <button class="bg-transparent hover:bg-gray-700 focus:bg-gray-700 text-white hover:text-indigo-500 focus:text-indigo-500 p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>

                <!-- Restaurant Category Card 2 -->
                <div class="bg-gray-800 rounded-lg p-4 flex items-center justify-between">
                    <div class="text-lg font-semibold">Category 2</div>
                    <button class="bg-transparent hover:bg-gray-700 focus:bg-gray-700 text-white hover:text-indigo-500 focus:text-indigo-500 p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>

                <!-- Restaurant Category Card 3 -->
                <div class="bg-gray-800 rounded-lg p-4 flex items-center justify-between">
                    <div class="text-lg font-semibold">Category 3</div>
                    <button class="bg-transparent hover:bg-gray-700 focus:bg-gray-700 text-white hover:text-indigo-500 focus:text-indigo-500 p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </section>
    </main>

@endsection
