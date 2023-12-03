@extends('layout.main')
<div class="flex flex-col gap-3 p-6 justify-center items-center">
    <p>Hello {{$order->user->name}} !!</p>
    <p>Your order is now in the {{$order->status->name}} state</p>
    <p>Thanks for you patience</p>
    <h2>Here are your foods :</h2>
    <ul>
        @foreach($order->food as $food)
            <li>
                {{$food->name}} | {{$food->price}} | {{$food->pivot->count}}
            </li>
        @endforeach
    </ul>
    <p>Total Price: {{$order->total_price}}</p>
    <a class="text-white font-semibold button bg-fuchsia-800 p-3 rounded" href="http://localhost:8000">Informed</a>
</div>
@section('content')@endsection
