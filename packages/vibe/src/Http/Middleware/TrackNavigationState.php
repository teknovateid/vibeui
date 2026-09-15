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
        // Proses untuk request GET halaman (baik browser normal maupun Livewire wire:navigate)
        if ($request->isMethod('GET') && ! $request->is('livewire/update') && ! $request->is('livewire/message/*')) {
            $currentRoute = $request->route()?->getName() ?: trim($request->path(), '/');
            $confirmedRoute = $request->session()->get('auth.confirmed_route');
            $isSinglePage = $request->session()->get('auth.is_single_page_confirm');

            // Jika sedang dalam mode single-page confirm dan pengguna berpindah ke rute yang berbeda
            if ($isSinglePage && $confirmedRoute && $currentRoute !== $confirmedRoute && $currentRoute !== 'password.confirm') {
                $request->session()->forget('auth.confirmed_route');
                $request->session()->forget('auth.password_confirmed_at');
                $request->session()->forget('auth.is_single_page_confirm');
            }
        }

        return $next($request);
    }
}
