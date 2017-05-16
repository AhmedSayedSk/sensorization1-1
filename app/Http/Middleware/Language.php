<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;

use App;
use Session;

class Language {

    public function __construct(Application $app, Redirector $redirector, Request $request) {
        $this->app = $app;
        $this->redirector = $redirector;
        $this->request = $request;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $default = config('app.locale');
 
        // 2. retrieve selected locale if exist (otherwise return the default)
        $locale = Session::get('locale', $default);
 
        // 3. set the locale
        App::setLocale($locale);
 
        return $next($request);
    }

}