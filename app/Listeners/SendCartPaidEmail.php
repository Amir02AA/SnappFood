<?php

namespace App\Listeners;

use App\Events\CartPaid;
use App\Mail\CartPaidEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendCartPaidEmail
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
    public function handle(CartPaid $event): void
    {
        Mail::to($event->cart->user)
            ->send(new CartPaidEmail($event->cart));
    }
}
