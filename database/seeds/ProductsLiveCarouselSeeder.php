<?php

use Illuminate\Database\Seeder;
use App\Models\Product\LiveCarousel;

class ProductsLiveCarouselSeeder extends Seeder
{
    
    public function run()
    {
    	function UniqueRandomNumbersWithinRange($min, $max, $quantity) 
        {
		    $numbers = range($min, $max);
		    shuffle($numbers);
		    return array_slice($numbers, 0, $quantity);
		}

		$a = UniqueRandomNumbersWithinRange(1, 30, 8);

        for ($i=1; $i <= 8; $i++) {       	
        	$productCarousel = new LiveCarousel;
        	$productCarousel->product_id = $a[$i-1];
	     	$productCarousel->save();
        }

    }
}
