@extends('layout.main')
@section('content')
    <main class="min-h-screen bg-gray-900 text-white flex items-center justify-center">
        <a href="{{route('admin.panel')}}" class="fixed top-3 left-4" > <!-- Home -->
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="#db2777" d="M10 20v-6h4v6h5v-8h3L12 3L2 12h3v8z"/></svg>
        </a>
        <a href="{{route('admin.off.index')}}" class="fixed top-12 left-4" > <!-- index -->
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 512 512"><path fill="none" stroke="#db2777" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M160 144h288M160 256h288M160 368h288"/><circle cx="80" cy="144" r="16" fill="none" stroke="#db2777" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><circle cx="80" cy="256" r="16" fill="none" stroke="#db2777" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><circle cx="80" cy="368" r="16" fill="none" stroke="#db2777" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
        </a>
        <section class="w-full h-screen flex items-center justify-center">
            <div class="bg-gray-800 p-8 rounded-lg text-center">
                <div class="text-4xl font-semibold mb-4">id : {{$off->id}}</div>
                <p class="text-gray-400">Percent: {{$off->percent}}</p>
                <p class="text-gray-400">Code: {{$off->code}}</p>

                <a href="{{route('admin.off.index')}}" class="flex items-center justify-end text-indigo-500 hover:text-indigo-400 mt-4">
                    Back
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </section>
    </main>


@endsection
