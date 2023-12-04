@extends('layout.main')
@section('content')
    @php $weekDay= ['saturday','sunday','monday','tuesday','wednesday','thursday','friday'] @endphp
    <main class="min-h-screen bg-blue-200 p-8 w-full">
        <div
            class="w-full max-w-md mx-auto bg-white p-8 rounded-md shadow-md border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <form action="{{route('sales.schedule.update')}}" method="post">
                @csrf @method('patch')
                <div class="mb-4">
                    <label for="day" class="block text-white font-semibold mb-2">Select Day:</label>
                    <select id="day" name="day" class="w-full p-2 border border-gray-300 rounded-md">
                        @foreach($weekDay as $day)
                            <option value="{{$day}}">{{ucfirst($day)}}</option>
                        @endforeach
                        <option value="not_friday">Every Day But Friday</option>
                        <option value="all">Every Day</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="start_time" class="block text-white font-semibold mb-2">Start Time:</label>
                    <input type="time" id="start_time" name="start_time"
                           class="w-full p-2 border border-gray-300 rounded-md"
                           required>
                </div>

                <div class="mb-4">
                    <label for="end_time" class="block text-white font-semibold mb-2">End Time:</label>
                    <input type="time" id="end_time" name="end_time"
                           class="w-full p-2 border border-gray-300 rounded-md"
                           required>
                </div>

                <button type="submit"
                        class="bg-blue-500 text-white py-2 px-3.5 rounded-md hover:bg-blue-700 transition duration-300">
                    Set
                </button>
            </form>

        </div>
        <div class="mt-8  border border-gray-200 dark:bg-gray-800 dark:border-gray-700 p-8 rounded-md shadow-md">
            <form action="{{route('sales.schedule.close')}}" method="post"> @csrf
                <table class="w-full border border-collapse border-gray-300 bg-gray-500">
                    <thead>
                    <tr>
                        <td>Saturday</td>
                        <td>Sunday</td>
                        <td>Monday</td>
                        <td>Tuesday</td>
                        <td>Wednesday</td>
                        <td>Thursday</td>
                        <td>Friday</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="border p-2">08:00 - 18:00</td>
                        <td class="border p-2">08:00 - 18:00</td>
                        <td class="border p-2">08:00 - 18:00</td>
                        <td class="border p-2">08:00 - 18:00</td>
                        <td class="border p-2">08:00 - 18:00</td>
                        <td class="border p-2">08:00 - 18:00</td>
                        <td class="border p-2">08:00 - 18:00</td>
                    </tr>
                    <tr>
                        @foreach($weekDay as $day)
                            <td class="border p-2">
                                <button type="submit" value="{{$day}}" name="day"
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
