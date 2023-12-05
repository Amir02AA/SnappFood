<?php

namespace App\Observers;

use App\Classes\Days;
use App\Models\Restaurant;

class RestaurantObserver
{
    public function created(Restaurant $restaurant): void
    {
        $restaurant->schedules()->createMany([
            ['day' => Days::Saturday, 'start_time' => '08:00', 'end_time' => '22:00'],
            ['day' => Days::Sunday, 'start_time' => '08:00', 'end_time' => '22:00'],
            ['day' => Days::Monday, 'start_time' => '08:00', 'end_time' => '22:00'],
            ['day' => Days::Tuesday, 'start_time' => '08:00', 'end_time' => '22:00'],
            ['day' => Days::Wednesday, 'start_time' => '08:00', 'end_time' => '22:00'],
            ['day' => Days::Thursday, 'start_time' => '08:00', 'end_time' => '22:00'],
            ['day' => Days::Friday, 'start_time' => '08:00', 'end_time' => '22:00'],
        ]);
    }
}
