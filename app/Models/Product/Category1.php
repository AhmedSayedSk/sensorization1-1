<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Category1 extends Model
{
    protected $table = "products_categories_1";

    public function sub_cat() {
        return $this->hasMany('App\Models\Product\Category2', 'related_id', 'id');
    }
}
