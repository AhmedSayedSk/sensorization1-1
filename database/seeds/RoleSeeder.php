<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Role;
use Faker\Factory as Faker;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

    	$list = [
    		'create_products',
    		'edit_products',
    		'delete_products',
    		'products_live_status',
            'products_carousel_controls',
    		'delete_users',
    		'carts_controls',
            'tags_controls'
    	];

        foreach ($list as $key => $value) {
        	$role = new Role;
            $role->name = $value;
        	$role->description = $faker->sentence($nbWords = 4, $variableNbWords = true);
        	$role->save();
        }   
    }
}
