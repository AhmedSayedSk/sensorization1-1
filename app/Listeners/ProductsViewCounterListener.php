<?php

namespace App\Listeners;

use App\Events\ProductsViewCounterEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductsViewCounterListener
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
     * @param  ProductsViewCounterEvent  $event
     * @return void
     */
    public function handle(ProductsViewCounterEvent $event)
    {
        //
    }
}
