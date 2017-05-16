<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class TagRelationship extends Model
{
    public $timestamps = false;
    protected $table = "products_tags_relationship";
}
