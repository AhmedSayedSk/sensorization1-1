<?php

namespace App\Http\Middleware;

use Illuminate\Http\Response;
use Closure;
use Auth;
use App\Models\Admin\Admin;

class RoleAuthenticate
{
    public function handle($request, Closure $next, ...$notaries)
    {
        if(Auth::check()){
            if(in_array(Admin::type(), $notaries)){
                return $next($request);
            } else {
                return new Response(abort(404));
            }
        } else {
            return new Response(abort(404));
        }
    }
}
