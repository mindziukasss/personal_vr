<?php

namespace App\Http\Middleware;

use Closure;

class UserCheck
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
       // dd(auth()->user()->role->pluck('id')->toArray());// check data
        if (in_array('super-admin', auth()->user()->role->pluck('id')->toArray()))
         {
            return $next($request);
        } else {
            return redirect('login');
        }
    
    }
}
