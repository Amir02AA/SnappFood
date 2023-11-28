<?php

namespace App\Http\Controllers\salesman;

use App\Charts\IncomeChart;
use App\Charts\NewChart;
use App\Http\Controllers\Controller;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Models\User;

class ChartController extends Controller
{
    public function index()
    {
        $dataset = Auth::user()->restaurant->carts->map(function ($cart){
            return $cart->total_fee;
        });
        $chart = new NewChart();
        $chart->labels(['One', 'Two', 'Three', 'Four']);
//        $chart->dataset('My dataset', 'line', [1, 2, 3, 4]);
        $chart->dataset('My dataset 2', 'line',$dataset );
        return view('sales.charts',compact('chart'));
    }

    public function index2(IncomeChart $chartObject)
    {
        $newChart = new IncomeChart(new LarapexChart());
        $chart = $chartObject->build();
        return view('sales.charts',compact('chart'));
    }

    public function index3()
    {
        $chart_options = [
            'chart_title' => 'Users by days',
            'report_type' => 'group_by_date',
            'model' => User::class,
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'bar',
        ];
        $chart1 = new LaravelChart($chart_options);

        return view('sales.charts', compact('chart1'));
    }
}
