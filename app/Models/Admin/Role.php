<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	//public $timestamps = false;

	public static $rules = [
        'name' => 'required|string|min:1|max:100',
        'description' => 'string'
    ];
}
