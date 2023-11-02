@extends('layout.main')

@section('content')
    <!-- Restaurant Categories Page -->
    <main class="bg-blue-200 mx-auto flex min-h-screen w-full items-center justify-center text-white">
        <a href="{{route('sales.dashboard')}}" class="fixed top-4 left-4"> <!-- Home -->
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
                <path fill="#1f2937" d="M10 20v-6h4v6h5v-8h3L12 3L2 12h3v8z"/>
            </svg>
        </a>

        <a href="{{route('sales.food.create')}}" class="fixed top-4 right-4 "> <!-- Add -->
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 20 20">
                <path fill="#1f2937" d="M11 9V5H9v4H5v2h4v4h2v-4h4V9h-4zm-1 11a10 10 0 1 1 0-20a10 10 0 0 1 0 20z"/>
            </svg>
            </svg>
        </a>
        <section class="flex w-[30rem] flex-col space-y-6">
            <div class="text-center text-4xl font-medium text-black">Restaurant Foods</div>

            <!-- Restaurant Category Cards -->
            <div class="w-full space-y-4">
                <!-- Restaurant Category Card 1 -->
                @foreach($foods as $food)
                    <div class="bg-gray-800 rounded-lg p-4 flex items-center justify-between">
                        <div>
                            <div class="text-lg font-semibold">{{$food->name}}</div>
                            <div class="text-sm font-semibold">{{$food->final_price}}{{" ===> "}}{{(int)$food->off?->percent." %off"}} </div>
                        </div>
                        <div class="flex flex-row items-center justify-between gap-2">

                            <a href="{{route('sales.food.show',$food)}}"
                               class="bg-transparent hover:bg-gray-700 focus:bg-gray-700 text-white hover:text-indigo-500 focus:text-indigo-500 p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                            <form method="post" action="{{route('sales.food.destroy',$food)}}">
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
                {{$foods->links()}}
            </div>
        </section>
    </main>

@endsection
