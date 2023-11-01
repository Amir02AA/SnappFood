@extends('layout.main')

@section('content')
    <!-- Admin Panel Page with User-Friendly Navbar -->
    <main class="min-h-screen bg-gray-900 text-white">
        <section class="flex">
            <!-- Navbar -->
            <nav class="bg-gray-800 h-screen w-64 p-4 flex flex-col space-y-4">
                <!-- Admin Logo -->
                <div class="text-2xl font-semibold text-white">Admin Panel</div>

                <!-- Admin Menu Buttons -->
                <a href="#" class="text-white hover:text-indigo-500">Dashboard</a>
                <a href="#" class="text-white hover:text-indigo-500">Users</a>
                <a href="#" class="text-white hover:text-indigo-500">Products</a>
                <a href="#" class="text-white hover:text-indigo-500">Settings</a>

                <!-- Logout Button at the Bottom -->
                <a href="#" class="text-indigo-500 hover:text-indigo-400 mt-auto">Logout</a>
            </nav>

            <!-- Admin Content -->
            <div class="flex-grow p-4">
                <!-- Your admin content goes here -->
                <!-- This area will display the content for the selected menu item -->
            </div>
        </section>
    </main>
@endsection
