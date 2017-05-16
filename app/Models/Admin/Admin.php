<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Admin extends Model
{
    public function scopeType($query){
    	if(Auth::check()){
    		$admin_type = $query->where('user_id', Auth::user()->id)->value('type');
    		if(!empty($admin_type)) {
    			return $admin_type;
    		} else {
    			return "user";
    		}
    	} else {
    		return "visitor";
    	}
    }
}
