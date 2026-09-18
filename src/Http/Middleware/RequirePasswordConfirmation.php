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
        $isSessionLocked = (bool) $request->session()->get('auth.session_locked', false);
        $now = Date::now()->unix();

        // 1. Mode dengan durasi waktu spesifik (misal 'confirm:300')
        if ($timeoutSeconds !== null) {
            $isExpired = $isSessionLocked || ! $confirmedAt || ($now - (int) $confirmedAt) >= $timeoutSeconds;

            if ($isExpired) {
                $request->session()->forget('auth.password_confirmed_at');

                return $this->requireConfirmation($request, $redirectToRoute);
            }

            $request->attributes->set('vibeIdleTimeout', $timeoutSeconds);

            return $next($request);
        }

        // Cek apakah rute ini secara spesifik menggunakan alias bawaan Laravel 'password.confirm' (misal pada Passkeys)
        $routeMiddlewares = $request->route()?->gatherMiddleware() ?? [];
        $isStandardLaravelConfirm = in_array('password.confirm', $routeMiddlewares, true) ||
            collect($routeMiddlewares)->contains(fn ($m) => is_string($m) && str_starts_with($m, 'password.confirm'));

        if ($isStandardLaravelConfirm) {
            $defaultTimeout = (int) config('auth.password_timeout', 10800);
            $isExpired = $isSessionLocked || ! $confirmedAt || ($now - (int) $confirmedAt) >= $defaultTimeout;

            if ($isExpired) {
                $request->session()->forget('auth.password_confirmed_at');

                return $this->requireConfirmation($request, $redirectToRoute);
            }

            return $next($request);
        }

        // 2. Mode: Single-page confirmation (default saat menggunakan middleware 'confirm')
        $routeName = $request->route()?->getName();
        $routePath = trim($request->path(), '/');
        $currentUrl = $request->url();
        $currentIdentifier = $routeName ?: $routePath;

        $confirmedRoute = $request->session()->get('auth.confirmed_route');
        $targetRoute = $request->session()->get('auth.target_route');
        $intendedUrl = $request->session()->get('url.intended');

        // Jika baru saja terkonfirmasi (misal via passkey callback / redirect setelah confirm)
        // dan route target atau intended URL cocok dengan request saat ini, otorisasi confirmed_route
        $possibleTargets = array_filter([$targetRoute, $intendedUrl]);
        if (! $confirmedRoute && $confirmedAt && count($possibleTargets) > 0) {
            foreach ($possibleTargets as $candidate) {
                $candidatePath = trim(parse_url($candidate, PHP_URL_PATH) ?? '', '/');
                $isTargetMatch = (
                    $candidate === $routeName ||
                    $candidate === $routePath ||
                    $candidate === $currentUrl ||
                    ($candidatePath && $candidatePath === $routePath)
                );

                if ($isTargetMatch) {
                    $request->session()->put('auth.confirmed_route', $candidate);
                    $request->session()->put('auth.is_single_page_confirm', true);
                    $request->session()->forget('auth.target_route');
                    $request->session()->forget('auth.session_locked');
                    $confirmedRoute = $candidate;
                    break;
                }
            }
        }

        $isRouteMatched = $confirmedRoute && (
            $confirmedRoute === $routeName ||
            $confirmedRoute === $routePath ||
            $confirmedRoute === $currentUrl ||
            trim(parse_url($confirmedRoute, PHP_URL_PATH) ?? '', '/') === $routePath
        );

        if (! $isSessionLocked && $isRouteMatched) {
            $request->session()->forget('auth.session_locked');
        }

        if ($isSessionLocked || ! $confirmedAt || ! $isRouteMatched) {
            $request->session()->forget('auth.password_confirmed_at');
            $request->session()->forget('auth.confirmed_route');
            $request->session()->forget('auth.is_single_page_confirm');

            $request->session()->put('auth.target_route', $currentIdentifier);
            $request->session()->put('auth.is_single_page_confirm', true);

            return $this->requireConfirmation($request, $redirectToRoute);
        }

        $response = $next($request);

        // One-time consume: jika aksi mutasi (non-GET) dan tanpa parameter waktu (confirm murni), hanguskan sesi konfirmasi
        if (! $request->isMethod('GET') && $timeoutSeconds === null) {
            $request->session()->forget([
                'auth.password_confirmed_at',
                'auth.confirmed_route',
                'auth.is_single_page_confirm',
                'auth.one_time_confirmed',
            ]);
        }

        // Header anti-cache agar riwayat browser dan wire:navigate tidak menyajikan snapshot sensitif tanpa verifikasi ulang
        if (method_exists($response, 'header')) {
            $response->header('Cache-Control', 'no-cache, no-store, must-revalidate, max-age=0');
            $response->header('Pragma', 'no-cache');
        }

        return $response;
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
