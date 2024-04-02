<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class TeamAuthenticate
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('team')->check()) {
            return $next($request);
        }

        return redirect()->route('login', ['lang' => app()->getLocale()]);
    }
}
