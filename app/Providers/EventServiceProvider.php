<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

    protected $listen = [
        'App\Events\ProductsViewCounterEvent' => [
            'App\Listeners\ProductsViewCounterListener',
        ],
    ];

    public function boot(DispatcherContract $events) {
        parent::boot($events);
        $events->listen('products.view_counter', 'App\Events\ProductsViewCounterEvent');
    }
}
