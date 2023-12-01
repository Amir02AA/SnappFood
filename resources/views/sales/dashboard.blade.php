@extends('layout.main')
@php
$banner = \App\Models\Banner::query()->inRandomOrder()->first();
@endphp
@section('content')
    <main class="min-h-screen bg-gray-900 text-white">
        <aside id="default-sidebar"
               class="fixed top-0 right-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
               aria-label="Sidebar">
            <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800 flex flex-col gap-3 justify-between">
                <form method="get">
                    <ul class="space-y-3 font-medium">
                        <li>
                            <div class="flex flex-row gap-3">
                                <div class="w-full  text-lg duration-300 focus-within:border-indigo-500">
                                    <select id="food_id" name="status"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">Choose a Status</option>
                                        <option value="1">waiting</option>
                                        <option value="2">accepted</option>
                                        <option value="3">processing</option>
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
                <div>
                    <img src="{{asset('images/'.$banner->image)}}" alt="banner"/>
                </div>
            </div>

        </aside>
        <section class="flex">
            <!-- Navbar -->
            <nav class="bg-gray-800 h-screen w-64 p-4 flex flex-col space-y-4">

                <div class="text-2xl font-semibold text-white">salesman Dashboard</div>

                <a href="{{route('sales.settings')}}" class="text-white hover:text-indigo-500">Restaurant Settings</a>
                <a href="{{route('sales.food.index')}}" class="text-white hover:text-indigo-500">Food</a>
                <a href="{{route('sales.carts.archive')}}" class="text-white hover:text-indigo-500">Archive</a>
                <a href="{{route('sales.comment.index')}}" class="text-white hover:text-indigo-500">Comments</a>
                <p class="text-white hover:text-indigo-500">Restaurant : {{\Illuminate\Support\Facades\Auth::user()->restaurant->name}}</p>


                <form method="post" action="{{route('logout')}}">
                    @csrf
                    <button type="submit" class="text-red-400 hover:text-indigo-400 mt-auto">Logout</button>
                </form>
            </nav>


            <section class="flex w-full flex-col items-center justify-center space-y-6 p-4 mx-auto">
                <div class="text-center text-4xl font-medium text-white">Orders</div>

                <!-- Restaurant Category Cards -->
                <div class="w-full space-y-4 flex flex-col items-center">
                    <!-- Restaurant Category Card 1 -->

                    @foreach($carts as $cart)
                    <div class="w-1/2 bg-gray-800 rounded-lg p-4 flex items-center justify-between">

                            <div>
                                <div class="text-lg font-semibold">Bought by: {{$cart->user->name}}</div>
                                <div class="text-sm font-semibold">Paid at: {{$cart->paid_date}}</div>
                                <div class="text-sm font-semibold">Total: {{$cart->total_fee_after_off}} T</div>
                                <div class="text-sm font-semibold">{{$cart->status->name}}</div>
                            </div>
                            <div class="flex flex-row items-center justify-between gap-2">

                                <a href="{{route('sales.order.next',$cart)}}"
                                   class="bg-transparent hover:bg-gray-700 focus:bg-gray-700 text-white hover:text-indigo-500 focus:text-indigo-500 p-2 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                        <path fill="currentColor"
                                              d="m16 8l-1.43 1.393L20.15 15H8v2h12.15l-5.58 5.573L16 24l8-8l-8-8z"/>
                                        <path fill="currentColor"
                                              d="M16 30a14 14 0 1 1 14-14a14.016 14.016 0 0 1-14 14Zm0-26a12 12 0 1 0 12 12A12.014 12.014 0 0 0 16 4Z"/>
                                    </svg>
                                </a>
                                <form method="post" action="{{route('sales.order.cancel',$cart)}}">
                                    @csrf @method('delete')
                                    <button type="submit"
                                            class="bg-transparent hover:bg-gray-700 focus:bg-gray-700 text-white hover:text-indigo-500 focus:text-indigo-500 p-2 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24">
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
        </section>
    </main>
@endsection
