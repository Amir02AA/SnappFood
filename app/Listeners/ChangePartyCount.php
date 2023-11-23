<?php

namespace App\Listeners;

use App\Events\CartPaid;
use App\Models\Food;

class ChangePartyCount
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
        $cart = $event->cart;
        $cart->food()->with('party')->get()->transform(function (Food $food) {
            $partyCount = ($food->pivot->count >= $food->party->count) ? 0 : $food->party->count - $food->pivot->count;
            $food->party->update([
                'count' => $partyCount
           ]);
        });
    }
}
