<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

    	$user = new User;
    	$user->name = $faker->name;
    	$user->email = "user@sen.com";
        $user->password = bcrypt('123456');
    	$user->save();

    	/*for ($i = 1; $i <= 5; $i++) { 
	    	$user = new User;
	    	$user->name = $faker->name;
	    	$user->email = $faker->safeEmail;
	    	$user->password = bcrypt('123456');
	    	$user->save();	
    	}*/
    }
}
