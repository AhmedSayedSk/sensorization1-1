<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Session\Store;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

// use App\Models\Product\Product;

class ProductsViewCounterEvent extends Event
{
    use SerializesModels;
    private $session;

    public function __construct(Store $session) {
        $this->session = $session;
    }

    public function handle($product) {
        if (!$this->isProductViewed($product)) {
            $product->increment('view_counter');
            $this->storeProduct($product);
        }

        $products = $this->getViewedProducts();

        if (is_null($products)) {
            $products = $this->cleanExpiredViews($products);
            $this->storeProduct($products);
        }
    }

    private function getViewedProducts() {
        return $this->session->get('viewed_products', null);
    }

    private function isProductViewed($product){
        $viewed = $this->session->get('viewed_products', []);
        return array_key_exists($product->id, $viewed);
    }

    private function storeProduct($product) {
        $key = 'viewed_products.' . $product->id;
        $this->session->put($key, time());    
    }

    private function cleanExpiredViews($products){
        $time = time();
        $throttleTime = 3600;

        return array_filter($products, function ($timestamp) use ($time, $throttleTime) {
            return ($timestamp + $throttleTime) > $time;
        });
    }

    public function broadcastOn() {
        return [];
    }
}
