@extends('layout.main')
@section('content')

<h1>
    HIIIIIII
</h1>
    <form method="post" action="{{route('test2.dispatch')}}">
        @csrf
        <input type="text" name="content">
        <button type="submit">Event</button>
    </form>
@endsection
