<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckFacilitator
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
        if(auth()->user()->role_id === 2){
            return $next($request);
        }
        Auth::logout();
        return redirect('/login')->with('error', 'Unauthorized Request');
        
    }
}
