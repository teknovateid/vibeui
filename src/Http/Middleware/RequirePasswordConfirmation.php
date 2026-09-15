<?php

namespace Teknovate\VibeUi\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class RequirePasswordConfirmation
{
    /**
     * Handle an incoming request.
     *
     * Supports:
     * - 'confirm' (without parameters) -> Single page confirm if triggered, or standard password timeout
     * - 'confirm:300' -> Valid for 300 seconds
     * - 'confirm:password.confirm,300' -> Backward compatible with Laravel's route,timeout syntax
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|int|null  $param1
     * @param  string|int|null  $param2
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $param1 = null, $param2 = null)
    {
        $redirectToRoute = 'password.confirm';
        $timeoutSeconds = null;

        // Parse parameter fleksibel:
        // Jika param1 adalah angka, misal 'confirm:300'
        if (is_numeric($param1)) {
            $timeoutSeconds = (int) $param1;
        } elseif ($param1 !== null) {
            $redirectToRoute = $param1;
            if (is_numeric($param2)) {
                $timeoutSeconds = (int) $param2;
            }
        }

        $confirmedAt = $request->session()->get('auth.password_confirmed_at');
        $now = Date::now()->unix();

        // 1. Mode dengan durasi waktu spesifik (misal 'confirm:300')
        if ($timeoutSeconds !== null) {
            $isExpired = ! $confirmedAt || ($now - (int) $confirmedAt) >= $timeoutSeconds;

            if ($isExpired) {
                $request->session()->forget('auth.password_confirmed_at');

                return $this->requireConfirmation($request, $redirectToRoute);
            }

            $request->attributes->set('vibeIdleTimeout', $timeoutSeconds);

            return $next($request);
        }

        // 2. Mode: Single-page confirmation jika sesi is_single_page_confirm aktif
        $confirmedRoute = $request->session()->get('auth.confirmed_route');
        $isSinglePage = $request->session()->get('auth.is_single_page_confirm');
        $routeName = $request->route()?->getName();
        $routePath = trim($request->path(), '/');

        if ($isSinglePage) {
            $isRouteMatched = $confirmedRoute && (
                $confirmedRoute === $routeName ||
                $confirmedRoute === $routePath ||
                $confirmedRoute === $request->url()
            );

            if (! $confirmedAt || ! $isRouteMatched) {
                $request->session()->forget('auth.password_confirmed_at');
                $request->session()->forget('auth.confirmed_route');
                $request->session()->forget('auth.is_single_page_confirm');

                $request->session()->put('auth.target_route', $routeName ?: $routePath);
                $request->session()->put('auth.is_single_page_confirm', true);

                return $this->requireConfirmation($request, $redirectToRoute);
            }

            return $next($request);
        }

        // 3. Fallback: Standar konfirmasi password Laravel (misal password.confirm bawaan)
        $defaultTimeout = (int) config('auth.password_timeout', 10800);
        $isExpired = ! $confirmedAt || ($now - (int) $confirmedAt) >= $defaultTimeout;

        if ($isExpired) {
            $request->session()->forget('auth.password_confirmed_at');

            // Tandai rute target untuk diotorisasi setelah konfirmasi
            $request->session()->put('auth.target_route', $routeName ?: $routePath);
            $request->session()->put('auth.is_single_page_confirm', true);

            return $this->requireConfirmation($request, $redirectToRoute);
        }

        return $next($request);
    }

    /**
     * Response redirect atau JSON saat konfirmasi dibutuhkan.
     */
    protected function requireConfirmation(Request $request, string $redirectToRoute)
    {
        $targetUrl = route($redirectToRoute);

        // Jangan return json 423 jika ini adalah request navigasi Livewire wire:navigate
        if ($request->expectsJson() && ! $request->hasHeader('X-Livewire-Navigate')) {
            return response()->json([
                'message' => 'Password confirmation required.',
            ], 423);
        }

        $redirect = redirect()->guest($targetUrl);

        if ($request->hasHeader('X-Livewire-Navigate')) {
            $redirect->header('X-Livewire-Redirect', $targetUrl);
        }

        return $redirect;
    }
}
