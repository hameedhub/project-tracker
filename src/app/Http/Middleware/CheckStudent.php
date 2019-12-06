<?php

namespace App\Http\Middleware;

use Auth;

use Closure;

class CheckStudent
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
        if(auth()->user()->role_id === 3){
            return $next($request);
        }
        Auth::logout();
        return redirect('/login')->with('error', 'Unauthorized Request');
        
    }
}
