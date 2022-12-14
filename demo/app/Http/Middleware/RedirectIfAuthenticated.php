<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {  
        if(Auth::guard($guard)->check()) {
            if (in_array(Auth::user()->user_type_id,['1'])){
                return redirect()->route('admin.dashboard');
            }
            else{
                return redirect()->route('front.login');
            }
        }
        return $next($request);
        
    }
}
