<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdminLogin
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('loggedIn') || $request->session()->get('loggedIn') !== true) {
            return redirect('/admin')->with('error', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}
