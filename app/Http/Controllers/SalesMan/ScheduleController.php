<?php

namespace App\Http\Controllers\salesman;

use App\Http\Controllers\Controller;
use App\Http\Requests\CloseDayRequest;
use App\Http\Requests\SetScheduleTimeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function schedule()
    {
        if (Auth::user()->restaurant === null) {
            return redirect()->route('sales.profile');
        }
        return view('sales.schedule.index');
    }

    public function setTime(SetScheduleTimeRequest $request)
    {

    }

    public function closeDay(CloseDayRequest $request)
    {

    }
}
