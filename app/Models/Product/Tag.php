<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $timestamps = false;
    protected $table = "products_tags";

    public static $rules = [
        'tag_name' => "required|unique:products_tags"
    ];

    public function products(){
    	return $this->belongsToMany('App\Models\Product\Product', 'products_tags_relationship', 'tag_id', 'product_id');
    }
}
