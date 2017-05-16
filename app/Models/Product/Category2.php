<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Category2 extends Model
{
    protected $table = "products_categories_2";

    public function sub_cat() {
        return $this->hasMany('App\Models\Product\Category3', 'related_id', 'id');
    }
}
