<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Permission;
use App\Models\Admin\Admin;

class PermissionsSeeder extends Seeder
{
    public function run()
    {

    	$admin_userId = Admin::where('type', 'admin')->value('user_id');
    	$roles_ids = [1, 3, 7];

    	foreach ($roles_ids as $key => $role_id) {
    		$permission = new Permission;
	        $permission->concessionaire_id = $admin_userId;
	        $permission->role_id = $role_id;
	        $permission->save();
    	}
	        
    }
}
