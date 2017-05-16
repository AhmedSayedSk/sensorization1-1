<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Product\Tag;

class ProductsTagsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $unique_values = [];
    	
        for ($i = 1; $i <= 80; $i++) {
        	$productTag = new Tag;
        	$random_word = $faker->word;

        	if(!in_array($random_word, $unique_values)){
    			$productTag->tag_name = $random_word;
    			$unique_values[] = $random_word;
    			$productTag->save();
        	} else {
        		$i--;
        	}

        }
    }
}
