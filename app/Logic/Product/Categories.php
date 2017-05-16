<?php

namespace App\Logic\Product;
use DB;

class Categories
{
	public function getCategories(){
        for ($i=1; $i <= 4; $i++) { 
            $p_cats[] = DB::table("products_categories_$i")->get();
        }
        return $p_cats;
    }
}