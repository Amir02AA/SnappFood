@extends('layout.main')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <div class="w-1/2">
        {!! $chart->container() !!}
    </div>
    {!! $chart->script() !!}
@endsection
