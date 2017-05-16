<?php

namespace App\Http\Controllers\Admin\Clients;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\EditNormalAdminRequest;
use App\Http\Requests\AddAdminsRequest;
use App\Http\Requests\RolesRequest;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\Admin\Admin;
use App\Models\Admin\Role;
use App\Models\Admin\Permission;

use Session;
use Auth;

class normalAdminsController extends Controller
{
    public function __construct(){
        $this->middleware('authenticated:super_admin', ['only' => ['edit', 'update', 'destroy']]);
    }

    public function index(){
        $admins_ids = (Array) Admin::where('type', 'admin')->pluck('user_id');
    	$admins = User::orderBy('id', 'DESC')->whereIn('id', current($admins_ids))->paginate(100);

    	return view('back.clients.admins.view')->withAdmins($admins);
    }

    public function create(){
        $roles = Role::lists('name');
        return view('back.clients.admins.create')->withRoles($roles);
    }

    public function store(AddAdminsRequest $request, RolesRequest $request){
        $input = (object) $request->all();
        $roles = Role::lists('id', 'name');
        $roles = (object) current($roles);

        $user = new User;
        $user->name = $input->name;
        $user->email = $input->email;
        $user->password = bcrypt($input->password);
        $user->save();

        $admin = new Admin;
        $admin->user_id = $user->id;
        $admin->type = "admin";
        $admin->save();

        foreach ($input as $key => $value) {
            $array = explode('_', $key);
            if(end($array) == 'ROLE' && $value == 1){
                $key = explode('_', $key);
                $key = array_slice($key, 0, -1);
                $key = implode('_', $key);

                $per = new Permission;
                $per->concessionaire_id = $user->id;
                $per->role_id = $roles->$key;
                $per->save();
            }
        }

        Session::flash('flashMessage', [
            "type" => "success",
            "content" => "admin account was Created successfully."
        ]);

        if($input->isCreateNew) {
            return back();
        } else {
            return redirect('/admin/clients/admins/accounts');
        }
    }

    public function edit($id){
    	$admin = User::find($id);
        $permissions_ids = Permission::where('concessionaire_id', $id)->lists('role_id');
        $admin_roles = Role::whereIn('id', $permissions_ids)->lists('name');
        $roles = Role::lists('name');

    	return view('back.clients.admins.edit')
    		->withAdmin($admin)
            ->withAdmin_roles(current($admin_roles))
    		->withRoles($roles);
    }

    public function update(EditNormalAdminRequest $request, RolesRequest $request, $id){
    	$input = (object) $request->all();
        $roles = Role::lists('id', 'name');
        $roles = (object) current($roles);

        // Admin record in users table
    	$user = User::find($id);
    	$user->name = $input->user_name;
    	//$admin->email = $input->user_email;
    	$user->save();

        Permission::where('concessionaire_id', $id)->delete();

        foreach ($input as $key => $value) {
            $array = explode('_', $key);
            if(end($array) == 'ROLE' && $value == 1){
                $key = explode('_', $key);
                $key = array_slice($key, 0, -1);
                $key = implode('_', $key);

                $per = new Permission;
                $per->concessionaire_id = $id;
                $per->role_id = $roles->$key;
                $per->save();
            }
        }

        Session::flash('flashMessage', [
            "type" => "success",
            "content" => "Information was Updated successfully."
        ]);

    	return back();
    }

    public function destroy($id){
    	if(Auth::user()->id != $id){
    		User::destroy($id);
    	}
    	return back();
    }
}
