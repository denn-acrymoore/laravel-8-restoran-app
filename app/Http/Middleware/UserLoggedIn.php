<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserLoggedIn
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
        if(session()->has('LoggedAdmin'))
        {
            // Admin tidak boleh pesan barang
            return redirect()->route("product");
        }
        else
        {
            // User login tidak dicek karena halaman home terbuka untuk umum
            return $next($request);    
        }
    }
}
