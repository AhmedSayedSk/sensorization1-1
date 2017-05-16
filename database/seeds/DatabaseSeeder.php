<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(SuperAdminSeeder::class);
        $this->call(NormalAdminSeeder::class);
        $this->call(UsersSeeder::class);

        $this->call(RoleSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(CountriesSeeder::class);
        
        $this->call(ProductsCategoriesSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(ProductsTagsSeeder::class);
        $this->call(ProductsTagsRelationshipSeeder::class);
        $this->call(ProductsLiveCarouselSeeder::class);
    }
}
