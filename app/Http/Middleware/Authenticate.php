<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle($request, Closure $next, $guard = null, ...$params)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                $request->session()->flash('flashMessage', [
                    "type" => $params[0],
                    "content" => $params[1]
                ]);
                return redirect()->guest('/login');
            }
        }

        return $next($request);
    }
}
