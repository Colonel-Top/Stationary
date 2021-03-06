<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if(!Auth::check()){
            return redirect('/login');
        }
        
         if(Auth::check() && ($request->user()->roles != "admin"))
            return redirect('/');

        return $next($request);
    }
}
