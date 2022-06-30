<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {   
        if(session()->has('LoggedUser'))
        {
            return redirect('/');
        }
        else if(!session()->has('LoggedAdmin'))
        {
            return redirect('login')->with('failed', 'You must log in first');
        }
        else if(session()->has('LoggedAdmin'))
        {
            return $next($request);    
        }
    }
}
