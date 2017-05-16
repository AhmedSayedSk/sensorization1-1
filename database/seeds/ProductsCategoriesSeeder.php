<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Models\Product\Category1;
use App\Models\Product\Category2;
use App\Models\Product\Category3;
use App\Models\Product\Category4;

class ProductsCategoriesSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 4; $i++) { 
        	$cat1 = new Category1;
        	$cat1->name = $faker->sentence($nbWords = 1);
        	$cat1->save();
        }

        for ($i = 1; $i <= 4; $i++) { 
        	$sub_cat = new Category2;
        	$sub_cat->name = $faker->sentence($nbWords = 1);
        	$sub_cat->related_id = $i;
        	$sub_cat->save();
        }

        for ($i = 1; $i <= 4; $i++) { 
        	$sub_cat = new Category3;
        	$sub_cat->name = $faker->sentence($nbWords = 1);
        	$sub_cat->related_id = $i;
        	$sub_cat->save();
        }

        for ($i = 1; $i <= 4; $i++) { 
        	$sub_cat = new Category4;
        	$sub_cat->name = $faker->sentence($nbWords = 1);
        	$sub_cat->related_id = $i;
        	$sub_cat->save();
        }
    }
}
