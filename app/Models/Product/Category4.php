<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Category4 extends Model
{
    protected $table = "products_categories_4";

    public function sub_cat() {
        return $this->hasMany('App\Models\Product\Category5', 'related_id', 'id');
    }
}
