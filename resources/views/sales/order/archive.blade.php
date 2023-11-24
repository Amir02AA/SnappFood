@extends('layout.main')

@section('content')
    <main class="bg-blue-200 mx-auto flex min-h-screen w-full items-center justify-center text-white">
        <section class="flex w-[30rem] flex-col space-y-6">
            <div class="text-center text-4xl font-medium text-black">Archive Carts</div>
            @if($carts->isNotEmpty())

                <div class="w-full space-y-4 text-black">
                    <!-- Restaurant Category Card 1 -->
                    <!-- component -->
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                            <div class="py-2 inline-block  sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <table class="w-full">
                                        <thead class="bg-gray-200 border-b">
                                        <tr>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                Customer
                                            </th>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                Total Price (T)
                                            </th>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                Paid Date
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($carts as $cart)
                                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    {{$cart->user->name}}
                                                </td>
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    {{$cart->total_fee}}
                                                </td>
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    {{$cart->paid_date}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{$carts->links()}}
                </div>
            @endif
        </section>
    </main>

@endsection
