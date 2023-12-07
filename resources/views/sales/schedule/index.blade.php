@extends('layout.main')
@section('content')
    <main class="min-h-screen bg-blue-200 p-8 w-full">
        <div
            class="w-full max-w-md mx-auto bg-white p-8 rounded-md shadow-md border-4 border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <form action="{{route('sales.schedule.update')}}" method="post">
                @csrf @method('patch')
                <div class="mb-4">
                    <label for="day" class="block text-white font-semibold mb-2">Select Day:</label>
                    <select id="day" name="day" class="w-full p-2 border-4 border-gray-300 rounded-md">
                        @foreach($days as $day)
                            <option value="{{$day->day->value}}">{{ucfirst($day->day->name)}}</option>
                        @endforeach
                        <option value="not_friday">Every Day But Friday</option>
                        <option value="all">Every Day</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="start_time" class="block text-white font-semibold mb-2">Start Time:</label>
                    <input type="time" id="start_time" name="start_time"
                           class="w-full p-2 border-4 border-gray-300 rounded-md"
                           required>
                    @error('start_time') {{$message}} @enderror
                </div>

                <div class="mb-4">
                    <label for="end_time" class="block text-white font-semibold mb-2">End Time:</label>
                    <input type="time" id="end_time" name="end_time"
                           class="w-full p-2 border-4 border-gray-300 rounded-md"
                           required>
                    @error('end_time') {{$message}} @enderror
                </div>

                <button type="submit"
                        class="bg-blue-500 text-white py-2 px-3.5 rounded-md hover:bg-blue-700 transition duration-300">
                    Set
                </button>
            </form>

        </div>
        <div class="mt-8  border-4 border-gray-500 dark:bg-gray-800 dark:border-gray-800 p-8 rounded-md shadow-md">
            <form action="{{route('sales.schedule.close')}}" method="post"> @csrf
                <table class="w-full  border-4 border-collapse border-gray-800 bg-white">
                    <thead>
                    <tr>
                        @foreach($days as $day)
                            <td class="border-4 border-gray-800 p-2">{{$day->day->name}}</td>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @foreach($days as $day)

                            <td class="border-4 border-gray-800 p-2">
                                @empty($day->end_time)
                                    <span class="text-red-700 font-semibold">Closed</span>
                                @else
                                {{$day->start_time }}- {{$day->end_time}}
                                @endempty
                            </td>
                        @endforeach

                    </tr>
                    <tr>
                        @foreach($days as $day)
                            <td class="border-4 border-gray-800 p-2">
                                <button type="submit" value="{{$day->day->value}}" name="day"
                                        class="bg-red-500 text-white p-2 rounded-md hover:bg-blue-700 transition duration-300">
                                    Close
                                </button>
                            </td>
                        @endforeach
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </main>

@endsection
