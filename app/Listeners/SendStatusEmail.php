<?php

namespace App\Listeners;

use App\Events\CartStatusChanged;
use App\Mail\statusChangedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendStatusEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(CartStatusChanged $event): void
    {
        Mail::to($event->cart->user)
            ->send(new statusChangedMail($event->cart));
    }
}
