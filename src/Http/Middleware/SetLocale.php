<?php

namespace Teknovate\VibeUi\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * Sets the application locale from route parameter, session, or default.
     *
     * Supports:
     * - 'setlocale' (reads from session or configuration)
     * - 'setlocale:en' (forces specified locale)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $locale
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ?string $locale = null)
    {
        $supported = (array) config('vibe.locales', ['id', 'en']);

        if ($locale && in_array($locale, $supported, true)) {
            app()->setLocale($locale);
        } elseif ($request->hasSession() && $request->session()->has('locale')) {
            $sessionLocale = $request->session()->get('locale');
            if (in_array($sessionLocale, $supported, true)) {
                app()->setLocale($sessionLocale);
            }
        } elseif (session()->has('locale')) {
            $sessionLocale = session('locale');
            if (in_array($sessionLocale, $supported, true)) {
                app()->setLocale($sessionLocale);
            }
        }

        return $next($request);
    }
}
