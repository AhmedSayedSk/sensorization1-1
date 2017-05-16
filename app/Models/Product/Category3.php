<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Category3 extends Model
{
    protected $table = "products_categories_3";

    public function sub_cat() {
        return $this->hasMany('App\Models\Product\Category4', 'related_id', 'id');
    }
}
