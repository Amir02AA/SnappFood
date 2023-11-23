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
                                class="text-sm font-semibold">{{$food->final_price}}{{" ===> "}}{{$food->final_percent." %off"}} </div>
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
                            @php
                                $route = ($food->party !== null) ? 'sales.party.destroy' : 'sales.party.create';
                                $method = ($food->party !== null) ? 'post' : 'get';
                                $svg = ($food->party !== null) ?
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512"><path fill="green" d="m122.7 23.32l1.7 21.87l-16.7 14.25l21.4 5.17l8.4 20.25L149 66.18l21.8-1.75l-14.2-16.71l5.1-21.32l-20.3 8.35l-18.7-11.43zM464 32a16 16 0 0 0-16 16a16 16 0 0 0 16 16a16 16 0 0 0 16-16a16 16 0 0 0-16-16zM239.8 42.5a16 16 0 0 0-16 16a16 16 0 0 0 16 16a16 16 0 0 0 16-16a16 16 0 0 0-16-16zm183.9 6.84c-9.2 1.74-17.7 7.18-25.9 14.28c-7.6 6.53-14.7 14.66-20.7 23.45c-18.8 3.01-37.6 10.67-50.2 21.13c-16.1 13.2-30.4 35.8-38.2 59.1c-7.4 3.1-14.4 6.8-20.1 10.8c-15.5 10.9-23.5 31.8-29.4 50c-5.9 18.3-8.8 34.3-8.8 34.3l17.8 3.2s2.7-15 8.1-31.9c5.5-16.9 14.8-35.3 22.7-40.8c1.3-.9 3-1.9 4.5-2.8c-.6 5.7-.6 11.4.3 16.8c1.8 11.4 8 22.3 19 28.2c7.8 4.2 16.6 3.2 24 .2c7.4-3.1 14-8.2 19.7-14.2c5.7-6 10.4-13.1 13.2-20.6c2.8-7.5 3.8-16 .2-23.9h-.1c-3.9-8.4-11.4-13.8-19.4-16.1c-8-2.3-16.6-2.2-25.2-.9c-1.5.2-2.9.7-4.4 1c7.4-15.8 18-30.7 27.5-38.6c6.2-5.1 16.6-10 27.7-13.6c-1.4 3.8-2.5 7.6-3 11.5c-1.6 10.5.7 21.9 9.1 29.7c6.1 5.6 14.3 6.5 21.5 5.3c7.1-1.2 14-4.4 20.2-8.5c6.2-4.2 11.7-9.4 15.6-15.5c3.9-6.1 6.5-13.9 4-21.7v-.1c-3.3-10.07-11.5-16.99-20.6-20.27c-3.9-1.4-8-2.19-12.2-2.66c2.9-3.26 5.9-6.31 8.9-8.92c6.8-5.84 13.7-9.5 17.6-10.23l-3.4-17.68zM174.8 84.39l-15.2 9.56l34.5 55.25l-56.4 2.9l26.5 57.8l16.4-7.6l-15.5-33.6l60.6-3.1l-50.9-81.21zm216.4 19.31c6.1-.1 11.5.6 15.5 2.1c5.4 1.9 8.1 4.3 9.5 8.8c.4 1.1.2 3.3-1.9 6.6c-2.2 3.4-6.1 7.2-10.5 10.2c-4.5 3-9.5 5.1-13.2 5.7c-3.8.7-5.5 0-6.3-.7c-3.5-3.2-4.5-7.2-3.5-13.9c.8-5.4 3.3-11.9 7-18.6c1.2 0 2.3-.2 3.4-.2zM94.99 123a16 16 0 0 0-16 16a16 16 0 0 0 16 16A16 16 0 0 0 111 139a16 16 0 0 0-16.01-16zm356.11 37.2l-14.4 16.6l-21.8-1.8l11.4 18.8l-8.5 20.2l21.4-5l16.6 14.3l1.9-21.9l18.7-11.4l-20.2-8.5l-5.1-21.3zm-123.5 16.5c2.9.1 5.6.5 7.7 1.1c4.3 1.2 6.6 3 8.2 6.4c.9 1.9 1 5.4-.7 10c-1.7 4.7-5.2 10.1-9.4 14.6s-9.3 8.1-13.5 9.8c-4.2 1.7-6.8 1.6-8.5.7h-.1c-5.8-3.2-8.6-7.8-9.7-15.2c-1-6.3-.3-14.3 1.8-22.9c4.9-1.7 9.8-3.1 14.5-3.8c3.5-.5 6.7-.7 9.7-.7zm-202.4 51.9c-7.2-.2-11.7 1.5-14.5 4.3c-2.8 2.8-4.5 7.3-4.3 14.5c.2 7.3 2.6 16.9 7.2 27.6c9.2 21.5 27.3 47.4 51.6 71.8c24.3 24.3 50.3 42.3 71.8 51.5c10.6 4.6 20.2 7 27.5 7.2c7.3.3 11.7-1.5 14.5-4.3c2.8-2.8 4.6-7.2 4.3-14.5c-.2-7.3-2.6-16.9-7.2-27.6c-9.2-21.4-27.2-47.4-51.5-71.7c-24.3-24.4-50.3-42.4-71.8-51.6c-10.7-4.6-20.3-7-27.6-7.2zm232 31.3l-33 54l-29.1-27.9l-12.4 13l45.1 43.3l33.8-55.2l38.7 32.3l89.3-38.2l-7-16.6l-79.3 34l-46.1-38.7zM93.43 272.6l-17.64 57.9c41.41 49.1 89.71 76.7 142.11 94.7l21.6-6.6c-3.1-1.1-6.4-2.4-9.7-3.8c-24.4-10.4-51.7-29.6-77.3-55.3c-25.7-25.7-44.9-53-55.34-77.4c-1.41-3.2-2.65-6.4-3.73-9.5zm-23.82 78.2l-14.01 46c28.89 27 59 39.2 90.6 50.2l43.4-13.2c-43.2-17.6-84-43.3-119.99-83zM368 352a16 16 0 0 0-16 16a16 16 0 0 0 16 16a16 16 0 0 0 16-16a16 16 0 0 0-16-16zM49.81 415.9l-20.29 66.6l88.28-26.9c-22.77-9.1-45.78-20.7-67.99-39.7z"/></svg>'
                                    :'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 128 128"><path fill="#FFC107" d="M7.45 123.27c2.27 2.46 11.62-1.83 19-5.27c5.53-2.57 27.66-11.65 38.66-16.36c2.97-1.27 7.29-2.93 10.4-7.02c2.76-3.64 10.08-19.1-4.66-34.76c-14.96-15.9-30.37-11.51-36.13-7.43c-3.39 2.4-6.15 7.81-7.39 10.56c-5.24 11.62-12.71 32.91-15.75 41.28c-2.23 6.17-6.38 16.56-4.13 19z"/><path fill="#FF8F00" d="M25.85 66.49c.14 1.74.49 4.57 1.69 10.02c.82 3.74 2.16 7.66 3.25 10.25c3.27 7.79 7.86 10.93 12.51 13.45c7.9 4.28 13.27 5.08 13.27 5.08l-6.44 2.63s-3.9-.81-9.22-3.43c-5.07-2.5-10.35-6.73-14.21-15.01c-1.67-3.59-2.64-7.07-3.2-9.83c-.69-3.42-.8-5.36-.8-5.36l3.15-7.8zm-7.91 20.28s.8 6.49 6.16 14.68c6.28 9.58 15.05 11.15 15.05 11.15l-5.83 2.4s-6.51-1.99-12.7-10.44c-3.86-5.27-4.94-11.57-4.94-11.57l2.26-6.22zm-5.55 15.38s1.46 5.6 4.66 9.78c3.81 4.99 8.66 6.44 8.66 6.44l-4.47 1.98s-3.39-.71-7.1-5.41c-2.82-3.57-3.62-7.67-3.62-7.67l1.87-5.12z"/><path fill="#FFFDE7" d="M9.96 116.37c-.2-.45-.2-.96.01-1.4l25.47-52.82l4.19 15.75l-26.8 38.71c-.72 1.08-2.34.94-2.87-.24z" opacity=".44"/><linearGradient id="notoPartyPopper0" x1="74.384" x2="44.617" y1="61.839" y2="79.699" gradientUnits="userSpaceOnUse"><stop offset=".024" stop-color="#8F4700"/><stop offset="1" stop-color="#703E2D"/></linearGradient><path fill="url(#notoPartyPopper0)" d="M41.65 83.19c11.9 13.92 25.45 12.18 29.96 8.66c4.52-3.53 8.09-15.66-3.76-29.35c-12.42-14.34-26.48-10.25-29.73-7.15s-7.39 15.07 3.53 27.84z"/><path fill="#03A9F4" d="M82.52 88.92c-4.34-3.64-6.65-2.99-9.75-1.7c-4 1.66-10.29 2.89-18.83 0l2.57-6.19c5.07 1.71 8.74.88 11.91-.99c4.08-2.4 9.66-5.69 18.34 1.6c3.62 3.04 7.33 5.06 10.05 4.14c1.98-.66 3.03-3.61 3.56-5.96c.05-.21.13-.81.19-1.34c.48-3.67 1.28-11.59 7.18-15.64c6.31-4.33 12.94-4.33 12.94-4.33l1.2 11.92c-3.05-.45-5.17.17-6.96 1.16c-6.74 3.75-.87 18.15-11.36 22.99c-10.09 4.69-18.34-3.4-21.04-5.66z"/><path fill="#F44336" d="m45.4 73.72l-4.34-3.89c7.97-8.9 5.87-15.44 4.34-20.2c-.31-.96-.6-1.87-.79-2.74c-.68-3.08-.82-5.76-.61-8.1c-3.06-3.81-4.41-7.8-4.5-8.07c-1.86-5.63-.46-11.12 2.75-16.27C48.74 4 60.49 4 60.49 4l3.92 10.49c-2.98-.12-12.75.03-15.75 4.76c-3.79 5.96-1.3 9.64-1.12 10.06c.73-.95 1.47-1.71 2.13-2.3c4.79-4.25 8.95-4.86 11.6-4.62c2.98.27 5.68 1.77 7.61 4.23c2.11 2.7 2.98 6.21 2.31 9.4c-.65 3.11-2.72 5.74-5.83 7.41c-5.43 2.92-9.95 2.52-12.98 1.51c.02.07.03.15.05.22c.11.5.33 1.2.59 2.01c1.77 5.48 5.06 14.18-7.62 26.55zm7.35-37.53c.58.42 1.19.77 1.82 1.02c2.1.84 4.39.56 6.99-.84c1.53-.82 1.71-1.7 1.77-1.99c.18-.87-.12-1.98-.77-2.81c-.57-.73-1.23-1.11-2.02-1.19c-1.5-.13-3.53.82-5.56 2.63c-.97.87-1.71 1.94-2.23 3.18z"/><path fill="#F48FB1" d="m62.77 75.35l-6.21-.17s2.95-16.66 12.5-19.46c1.79-.52 3.75-1.05 5.72-1.34c1.17-.18 3.02-.45 3.93-.79c.21-1.57-.45-3.57-1.19-5.84c-.58-1.76-1.18-3.57-1.5-5.55c-.62-3.86.41-7.27 2.9-9.62c3.04-2.85 7.95-3.76 13.49-2.5c3.16.72 5.49 2.27 7.54 3.63c2.93 1.95 4.64 2.94 8.22.53c4.33-2.92-1.33-14.35-4.34-20.95l11.23-4.68c1.51 3.3 8.8 20.28 3.99 29.97c-1.62 3.26-4.41 5.42-8.07 6.23c-7.96 1.78-12.62-1.32-16.02-3.58c-1.61-1.07-3.02-1.91-4.55-2.35c-10.63-3.03 4.21 12.61-2.74 19.64c-4.17 4.21-14.36 5.32-15.02 5.48c-6.56 1.58-9.88 11.35-9.88 11.35z"/><path fill="#C92B27" d="M43.99 38.79c-.19 2.2-.28 3.51.29 6.37c2.75 2.02 8.74 2.02 8.74 2.02c-.26-.81-.49-1.51-.59-2.01c-.02-.07-.03-.15-.05-.22c-6.09-3.04-8.39-6.16-8.39-6.16z"/><path fill="#FFC107" d="m31.53 48.64l-10.34-5.07l5.15-7.44l8.11 5.37z"/><path fill="#FB8C00" d="M16.29 34.6c-5.28-.71-10.66-5.19-11.25-5.7l5.19-6.09c1.57 1.33 4.9 3.56 7.13 3.86l-1.07 7.93z"/><path fill="#03A9F4" d="m25.61 21.27l-7.6-2.49c.87-2.66 1.1-5.53.65-8.3l7.9-1.27c.65 4.02.32 8.19-.95 12.06z"/><path fill="#FB8C00" d="m73.073 15.325l7.815-1.71l2.257 10.316l-7.815 1.71z"/><path fill="#FFC107" d="m92.46 17.77l-5.5-5.81c2.88-2.73 3.54-6.3 3.54-6.34l7.9 1.29c-.1.63-1.11 6.29-5.94 10.86z"/><path fill="#FB8C00" d="m95.514 48.58l6.987-2.184l2.386 7.636l-6.987 2.184z"/><path fill="#F44336" d="m97.55 113.03l-7.95-.94c.34-2.83-1.77-6.3-2.35-7.07l6.4-4.8c.48.63 4.65 6.4 3.9 12.81z"/><path fill="#FB8C00" d="M120.37 102.89c-2.99-.45-6.05-.63-9.07-.52l-.27-8c3.51-.12 7.06.08 10.53.61l-1.19 7.91z"/><path fill="#F48FB1" d="m109.614 113.902l5.62-5.693l7.735 7.638l-5.62 5.692z"/><path fill="#F44336" d="m93.103 63.334l5.78 6.609l-6.609 5.78l-5.78-6.609z"/></svg>'
                            @endphp
                            <form action="{{route($route,$food)}}" method="{{$method}}">
                                @csrf
                                @if($method === 'post')
                                    @method('delete')
                                @endif
                                <button
                                    class="bg-transparent hover:bg-gray-700 focus:bg-gray-700 text-white hover:text-indigo-500 focus:text-indigo-500 p-2 rounded-full">
                                    {!! $svg !!}
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
