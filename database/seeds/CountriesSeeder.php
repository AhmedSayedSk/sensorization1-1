<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Models\Countries;

class CountriesSeeder extends Seeder
{
    public function run()
    {
    	$faker = Faker::create();

    	// Insert your available countries for your sells area
    	$countries = ['China', 'India', 'United State', 'Brazil', 'Russia', 'Japan'];

    	foreach ($countries as $key => $value) {
    		$country = new Countries;
    		$country->name = $value;
    		$country->save();
    	}
    }
}
