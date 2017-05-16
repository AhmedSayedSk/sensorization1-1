<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Closure;
use Session;

class VerifyCsrfToken extends BaseVerifier
{
    protected $except = [
       // '/*'
    ];

   	public function handle($request, Closure $next) 
    {
        if($request->input('_token')) 
        {
            if( \Session::getToken() != $request->input('_token')) 
            {
                return redirect()->guest('/');
            }
	      }

	    return parent::handle($request, $next);
	}
}
