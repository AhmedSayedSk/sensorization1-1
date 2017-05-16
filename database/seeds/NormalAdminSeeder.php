<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;
use App\Models\Admin\Admin;

class NormalAdminSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $user = new User;
        $user->name = $faker->name;
        $user->email = "normal-admin@sen.com";
        $user->password = bcrypt('123456');
        $user->save();

        $admin = new Admin;
        $admin->user_id = $user->id;
        $admin->type = 'admin';
        $admin->save();
    }
}

