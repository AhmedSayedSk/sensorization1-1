<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = "products_images";
    public $timestamps = false;

    public static $rules = [
        'file' => 'required|mimes:png,jpeg,jpg',
        'parent_id' => 'numeric'
    ];

    public static $messages = [
        'file.mimes' => 'Uploaded file is not in image format',
        'file.required' => 'Image is required'
    ];
}
