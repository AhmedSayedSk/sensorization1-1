<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Models\Product\Product;
use App\Models\Product\Image;

class ProductsSeeder extends Seeder
{
    public function run()
    {
    	$faker = Faker::create();
        //$setting = json_decode(Storage::get("setting.json"));
        //$site_category = $setting->site_category;

        for ($i = 1; $i <= 80; $i++) 
        {
        	$product = new Product;

            $product->serial_number = rand(10000000, 99999999);
        	$product->name = $faker->sentence($nbWords = 3, $variableNbWords = true);
        	$product->description = $faker->paragraph;
        	
        	$product->price = rand(100, 9999);
        	$product->discount_percentage = range(0, 40, 10)[rand(0, 4)];

            $product->is_amount_unlimited = rand(0, 1);
            $product->amount = rand(1, 500);
            $product->sales = rand(10, 90);                           
            
            $product->category_table_number = rand(1, 4);
            $product->category_id = rand(1, 4);
            /*switch($product->category_table_number){
                case 1: $product->category_id = rand(1, 4); break;
                case 2: $product->category_id = rand(1, 4); break;
                case 3: $product->category_id = rand(1, 4); break;
                case 4: $product->category_id = rand(1, 4); break;
            }*/

            $product->start_at = time();
            $product->is_forever = rand(0, 1);
            $product->expires_at = time() + rand(9999, 999999);

            $product->stars = number_format(rand(10, 50) / 10, 1, '.', '');
            $product->is_live = rand(0, 1);

            $product->is_new = rand(0, 1);
            $product->new_status_time = time();

            $product->is_payment_on_delivery = 1;
            $product->is_payment_by_paypal = rand(0, 1);

            $product->view_counter = rand(50, 999);  
            
        	$product->save();
        }
    }
}
