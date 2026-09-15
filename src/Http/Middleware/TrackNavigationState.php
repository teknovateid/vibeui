<?php

namespace Teknovate\VibeUi\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TrackNavigationState
{
    /**
     * Handle an incoming request.
     *
     * Clears single-page confirmation when the user navigates away to a different page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Jangan proses request background API / JSON kecuali jika ini adalah navigasi halaman Livewire
        if ($request->expectsJson() && ! $request->hasHeader('X-Livewire-Navigate')) {
            return $next($request);
        }

        // Proses hanya untuk request GET halaman (baik browser normal maupun Livewire wire:navigate)
        if ($request->isMethod('GET') && ! $request->is('livewire/update') && ! $request->is('livewire/message/*') && ! $request->is('livewire/livewire.js*')) {
            $routeName = $request->route()?->getName();
            $routePath = trim($request->path(), '/');
            $currentUrl = $request->url();

            $confirmedRoute = $request->session()->get('auth.confirmed_route');
            $targetRoute = $request->session()->get('auth.target_route');
            $isSinglePage = $request->session()->get('auth.is_single_page_confirm');

            $isAuthRoute = $request->routeIs(
                'password.confirm',
                'password.confirm.post',
                'password.lock',
                'password.idle-lock',
                'passkey.*',
                'auth.keep-alive'
            ) || $request->is('passkeys/*', 'keep-alive*');

            // Cek apakah rute saat ini sama dengan rute yang terkonfirmasi
            $isSameAsConfirmed = $confirmedRoute && (
                $confirmedRoute === $routeName ||
                $confirmedRoute === $routePath ||
                $confirmedRoute === $currentUrl ||
                trim(parse_url($confirmedRoute, PHP_URL_PATH) ?? '', '/') === $routePath
            );

            // Jika dalam mode single-page confirm dan berpindah ke rute yang bukan confirmed route dan bukan rute auth konfirmasi
            if ($isSinglePage && $confirmedRoute && ! $isSameAsConfirmed && ! $isAuthRoute) {
                $request->session()->forget('auth.confirmed_route');
                $request->session()->forget('auth.password_confirmed_at');
                $request->session()->forget('auth.is_single_page_confirm');
                $request->session()->forget('auth.target_route');
            }

            // Jika ada target_route tapi pengguna malah berpindah ke halaman lain (bukan confirm dan bukan target)
            if ($targetRoute && ! $isAuthRoute) {
                $isSameAsTarget = (
                    $targetRoute === $routeName ||
                    $targetRoute === $routePath ||
                    $targetRoute === $currentUrl ||
                    trim(parse_url($targetRoute, PHP_URL_PATH) ?? '', '/') === $routePath
                );

                if (! $isSameAsTarget) {
                    $request->session()->forget('auth.target_route');
                    $request->session()->forget('auth.is_single_page_confirm');
                }
            }
        }

        return $next($request);
    }
}
