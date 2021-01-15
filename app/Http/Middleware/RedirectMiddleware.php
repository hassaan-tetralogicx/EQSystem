<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectMiddleware
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
        if(!Auth::user()->hasRole('admin')){
            // dd('adm');
            return redirect()->route('employees.index');
        }
        // else {
        //     // dd('emp');
        //     return redirect()->route('employees.index');
        // }
        return $next($request);
    }
}
