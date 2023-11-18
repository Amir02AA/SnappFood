@extends('layout.main')

@section('content')
    <main class="min-h-screen bg-gray-900 text-white">
        <section class="flex">
            <!-- Navbar -->
            <nav class="bg-gray-800 h-screen w-64 p-4 flex flex-col space-y-4">

                <div class="text-2xl font-semibold text-white">salesman Dashboard</div>

                <a href="{{route('sales.settings')}}" class="text-white hover:text-indigo-500">Restaurant Settings</a>
                <a href="{{route('sales.food.index')}}" class="text-white hover:text-indigo-500">Food</a>
                <a href="{{route('sales.carts.archive')}}" class="text-white hover:text-indigo-500">Archive</a>
                <p class="text-white hover:text-indigo-500">Restaurant : </p>


                <form method="post" action="{{route('logout')}}">
                    @csrf
                    <button type="submit" class="text-indigo-500 hover:text-indigo-400 mt-auto">Logout</button>
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
                                <div class="text-lg font-semibold">{{$cart->id}}</div>
                                <div class="text-sm font-semibold">{{$cart->paid_date}}</div>
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
