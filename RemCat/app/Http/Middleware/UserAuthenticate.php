<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserAuthenticate
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('user')->check()) {
            return $next($request);
        }

        return redirect()->route('login', ['lang' => app()->getLocale()]);
    }
}