@extends('layout.main')

@section('content')
    <main class="bg-blue-200 mx-auto flex min-h-screen w-full items-center justify-center text-white">
        <aside id="default-sidebar"
               class="fixed top-0 right-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
               aria-label="Sidebar">
            <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
                <form>
                    <ul class="space-y-3 font-medium">
                        <li>
                            <div class="flex flex-row gap-3">
                                <div class="w-full  text-lg duration-300 focus-within:border-indigo-500">
                                    <select id="food_id" name="food_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">Choose a Food</option>
                                        @foreach($foods as $food)
                                            <option value="{{$food->id}}">{{$food->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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

        <a href="{{route('sales.dashboard')}}" class="fixed top-4 left-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
                <path fill="#1f2937" d="M10 20v-6h4v6h5v-8h3L12 3L2 12h3v8z"/>
            </svg>
        </a>


        <section class="flex w-[30rem] flex-col space-y-6">
            <div class="text-center text-4xl font-medium text-black">Comments</div>

            <div class="w-3/4 space-y-4 flex justify-center items-center mx-auto gap-5">

                @foreach($comments as $comment)
                    @php $component = 'comments.'.strtolower($comment->status->name) @endphp
                    <x-dynamic-component :component="$component" :$comment/>
                @endforeach
            </div>
        </section>
        <x-paginate/>
    </main>

@endsection
