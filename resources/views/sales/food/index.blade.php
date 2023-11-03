@extends('layout.main')

@section('content')
    <!-- Restaurant Categories Page -->
    <main class="bg-blue-200 mx-auto flex min-h-screen w-full items-center justify-center text-white">
        <aside id="default-sidebar"
               class="fixed top-0 right-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
               aria-label="Sidebar">
            <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
                <form method="get">
                    <ul class="space-y-3 font-medium">
                        <li>
                            <div class="flex flex-row gap-3">
                                <div class="w-full  text-lg duration-300 focus-within:border-indigo-500">
                                    <select id="tiers" name="tier_filter"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">Choose a Tier</option>
                                        @php $tiers = \App\Models\FoodTier::all(); @endphp
                                        @foreach($tiers as $tier)
                                            <option value="{{$tier->id}}">{{$tier->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </li>
                        <li>
                            <dive class="flex flex-row gap-3">
                                <div class="w-full  text-lg duration-300 focus-within:border-indigo-500">
                                    <select id="price" name="price_filter"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option disabled>Price</option>
                                        <option value='asc'>Ascending</option>
                                        <option value='desc'>Descending</option>
                                    </select>
                                </div>
                            </dive>
                        </li>
                        <li>
                            <dive class="flex flex-row gap-3">
                                <div class=" w-full text-lg duration-300 focus-within:border-indigo-500">
                                    <button
                                        class="bg-transparent hover:bg-blue-400 text-blue-500 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
                                        type="submit">Filter
                                    </button>
                                </div>
                            </dive>
                        </li>
                    </ul>
                </form>

            </div>
        </aside>
        <a href="{{route('sales.dashboard')}}" class="fixed top-3 left-4"> <!-- Home -->
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
                <path fill="#1f2937" d="M10 20v-6h4v6h5v-8h3L12 3L2 12h3v8z"/>
            </svg>
        </a>

        <a href="{{route('sales.food.create')}}" class="fixed top-14 left-5 z-50"> <!-- Add -->
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 20 20">
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
                            <div
                                class="text-sm font-semibold">{{$food->final_price}}{{" ===> "}}{{(int)$food->off?->percent." %off"}} </div>
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
