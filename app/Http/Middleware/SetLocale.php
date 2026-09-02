<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('locale') && in_array(session('locale'), ['id', 'en'])) {
            app()->setLocale(session('locale'));
        }

        return $next($request);
    }
}
