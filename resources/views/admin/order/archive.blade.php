@extends('layout.main')

@section('content')
    <main class="bg-blue-200 mx-auto flex min-h-screen w-full items-center justify-center text-white px-7">
        <a href="{{route('admin.panel')}}" class="fixed top-4 left-4" > <!-- Home -->
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="#1f2937" d="M10 20v-6h4v6h5v-8h3L12 3L2 12h3v8z"/></svg>
        </a>
{{--Admin Archive--}}
        <section class="flex w-full flex-col space-y-6 items-center justify-center">
            <div class="text-center text-4xl font-medium text-black w-full">Archive Carts (Orders)</div>
            <div class="w-full space-y-4 text-black flex flex-col items-center justify-center">
                <div class="px-9 w-full flex justify-between">
                    <div class="flex-col flex">
                        <label>Total Income : {{$totalIncome}} T</label>
                        <label>Carts Count : {{$carts->count()}}</label>
                    </div>
                    <div>
                        <form class="flex gap-2">
                            <div class="flex gap-2 p-2">
                                <label for="from">From</label>
                                <input id="from" type="date" name="from">
                            </div>
                            <div class="flex gap-2 p-2">
                                <label for="to">To</label>
                                <input id="to" type="date" name="to">
                            </div>
                            <button type="submit" class="button bg-indigo-600 text-white font-bold p-3">Filter</button>
                        </form>
                    </div>
                </div>
            @if($carts->isNotEmpty())
                    <div class="flex flex-col w-full">
                        <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5 w-full">
                            <div class="py-2 inline-block  sm:px-6 lg:px-8 w-full">
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
{{--                    {{$carts->links()}}--}}
                </div>
            @endif
            @error('from') {{$message}} @enderror
            @error('to') {{$message}} @enderror
        </section>
    </main>

@endsection
