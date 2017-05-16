<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Product\TagRelationship;

class ProductsTagsRelationshipSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 100; $i++) {
        	$table = new TagRelationship;
            $table->product_id = rand(1, 80);
            $table->tag_id = rand(1, 80);
        	$table->save();
        }
    }
}
