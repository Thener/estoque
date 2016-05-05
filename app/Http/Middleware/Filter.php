<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Filter {

    public function handle($request, Closure $next) {
    	
    	if (!$request->is('login') && Auth::guest()) {
    		return redirect('/login');
    	}
    	
        return $next($request);
    }
}
