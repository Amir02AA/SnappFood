@extends('layout.main')

@section('content')
    <main class="bg-blue-200 mx-auto flex min-h-screen w-full items-center justify-center text-white">
        <section class="flex w-[30rem] flex-col space-y-6">
            <div class="text-center text-4xl font-medium">Food Categories</div>
            <div class="w-full space-y-4">

                @foreach($food as $tier)
                    <div class="bg-gray-800 rounded-lg p-4 flex items-center justify-between">
                        <div class="text-lg font-semibold">{{$tier->name}}</div>
                        <div class="flex flex-row items-center justify-between gap-2">

                            <a href="{{route('admin.food.show',['food' => $tier])}}"
                               class="bg-transparent hover:bg-gray-700 focus:bg-gray-700 text-white hover:text-indigo-500 focus:text-indigo-500 p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                            <form method="post" action="{{route('admin.food.destroy',$tier)}}">
                                @csrf @method('delete')
                                <button type="submit"
                                        class="bg-transparent hover:bg-gray-700 focus:bg-gray-700 text-white hover:text-indigo-500 focus:text-indigo-500 p-2 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="red"
                                              d="M12 4c-4.419 0-8 3.582-8 8s3.581 8 8 8s8-3.582 8-8s-3.581-8-8-8zm3.707 10.293a.999.999 0 1 1-1.414 1.414L12 13.414l-2.293 2.293a.997.997 0 0 1-1.414 0a.999.999 0 0 1 0-1.414L10.586 12L8.293 9.707a.999.999 0 1 1 1.414-1.414L12 10.586l2.293-2.293a.999.999 0 1 1 1.414 1.414L13.414 12l2.293 2.293z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach

            </div>
        </section>
    </main>
@endsection
