@extends('layout.main')
<div class="flex flex-col gap-3 p-6 justify-center items-center">
    <p>Hello {{$cart->user->name}} !!</p>
    <p>Your cart is now in the {{$cart->status->name}} state</p>
    <p>Thanks for you patience</p>
    <h2>Here are your foods :</h2>
    <ul>
        @foreach($cart->food as $food)
            <li>
                {{$food->name}} | {{$food->price}} | {{$food->pivot->count}}
            </li>
        @endforeach
    </ul>
    <p>Total Price: {{$cart->total_fee}}</p>
    <a class="text-white font-semibold button bg-fuchsia-800 p-3 rounded" href="http://localhost:8000">Informed</a>
</div>
@section('content')@endsection
