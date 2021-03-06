<?php

namespace App\Listeners;

use App\Events\BuyBillEvent;
use App\Mail\BuyBillMail;
use App\Mail\OrderShipped;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class BuyBillListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\BuyBillEvent  $event
     * @return void
     */
    public function handle(BuyBillEvent $event)
    {

        Mail::to($event->user)->send(new BuyBillMail($event->user,$event->commande,$event->stream));
        //
    }
}
