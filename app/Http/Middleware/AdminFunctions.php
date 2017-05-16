<?php

namespace App\Http\Middleware;

use Illuminate\Http\Response;
use Closure;
use Auth;
use App\Models\Admin\Admin;
use App\Models\Admin\Permission;
use App\Models\Admin\Role;

class AdminFunctions
{
    public function handle($request, Closure $next, $method_name)
    {

        if(Auth::check()){
            $roles_ids = (Array) Permission::where('concessionaire_id', Auth::user()->id)->pluck('role_id');

            if(Admin::type() == 'super_admin'){
                return $next($request);
            }

            // get role id from method name coming from controllers
            $role_id = (Array) Role::where('name', $method_name)->value('id');

            if(Admin::type() == 'admin'){
                if(in_array($role_id[0], current($roles_ids))){
                    return $next($request);
                } else {
                    return new Response(abort(401));
                }
            } else {
                return new Response(abort(404));
            }
        } else {
            return new Response(abort(404));
        }
    }
}
