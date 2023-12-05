<?php

namespace App\Listeners;

use App\Events\OrderCanceled;
use App\Notifications\OrderCanceledNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class InformAboutCanceledOrder implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCanceled $event): void
    {
        Notification::send($event->order->user,new OrderCanceledNotification($event->order));
    }
}
