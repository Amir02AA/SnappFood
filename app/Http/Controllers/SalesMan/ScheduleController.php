<?php

namespace App\Http\Controllers\salesman;

use App\Classes\SalesHelper;
use App\Classes\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CloseDayRequest;
use App\Http\Requests\SetScheduleTimeRequest;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class ScheduleController extends Controller
{
    public function schedule()
    {
        if (Auth::user()->restaurant === null) {
            return redirect()->route('sales.profile');
        }
        $days = Auth::user()->restaurant->schedules->sortBy(function ($schedule){
            return $schedule->day->value;
        });
        return view('sales.schedule.index',compact('days'));
    }

    public function setTime(SetScheduleTimeRequest $request)
    {
        $validated = $request->validated();
        SalesHelper::manageDayTimeUpdating($validated['start_time'],$validated['end_time'],$validated['day']);
        return redirect()->route('sales.schedule.index');
    }

    public function closeDay(CloseDayRequest $request)
    {
        SalesHelper::manageDayTimeClosing($request->validated('day'));
        return redirect()->route('sales.schedule.index');
    }
}
