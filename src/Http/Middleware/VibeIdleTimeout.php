<?php

namespace Teknovate\VibeUi\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VibeIdleTimeout
{
    /**
     * Handle an incoming request.
     *
     * Locks session and redirects to confirmation if no request was made
     * within the specified timeout duration (default: 300 seconds).
     *
     * Supports:
     * - 'idle' (default 300s)
     * - 'idle:300'
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int|string|null  $timeoutSeconds
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $timeoutSeconds = 300)
    {
        $timeout = (int) ($timeoutSeconds ?: 300);

        if (Auth::check()) {
            // Abaikan rute auth agar tidak terjadi perulangan pengalihan
            if ($request->routeIs('password.confirm', 'logout', 'password.lock', 'login', 'register', 'auth.keep-alive')) {
                return $next($request);
            }

            $isLocked = (bool) $request->session()->get('auth.session_locked', false);
            $lastActivity = $request->session()->get('auth.last_activity_time');
            $now = time();

            // Jika sesi sedang terkunci atau durasi inaktivitas telah mencapai/melebihi batas waktu
            if ($isLocked || ($lastActivity && ($now - (int) $lastActivity) >= $timeout)) {
                // Kunci sesi pengguna
                $request->session()->put('auth.session_locked', true);
                $request->session()->forget('auth.password_confirmed_at');
                $request->session()->forget('auth.confirmed_route');

                // Simpan URL yang sedang dituju pengguna
                $request->session()->put('url.intended', $request->fullUrl());

                if ($request->expectsJson() && ! $request->hasHeader('X-Livewire-Navigate')) {
                    return response()->json([
                        'message' => 'Session locked due to inactivity.',
                    ], 423);
                }

                $confirmUrl = \Illuminate\Support\Facades\Route::has('password.confirm')
                    ? route('password.confirm')
                    : url('/confirm-password');

                $redirect = redirect($confirmUrl)->with('status', 'idle_timeout');

                if ($request->hasHeader('X-Livewire-Navigate')) {
                    $redirect->header('X-Livewire-Redirect', $confirmUrl);
                }

                return $redirect;
            }

            // Catat waktu aktivitas terbaru
            $request->session()->put('auth.last_activity_time', $now);

            // Simpan informasi timeout di request attribute agar hanya berlaku pada request saat ini
            $request->attributes->set('vibeIdleTimeout', $timeout);
        }

        $response = $next($request);

        if (method_exists($response, 'header')) {
            // Header anti-cache agar riwayat browser (Back button) dan wire:navigate tidak menyajikan snapshot sensitif tanpa verifikasi ulang
            $response->header('Cache-Control', 'no-cache, no-store, must-revalidate, max-age=0');
            $response->header('Pragma', 'no-cache');

            $response->header('X-Vibe-Idle-Timeout', (string) $timeout);
            if (\Illuminate\Support\Facades\Route::has('password.confirm')) {
                $response->header('X-Vibe-Confirm-Url', route('password.confirm', [], false));
            }
            if (\Illuminate\Support\Facades\Route::has('password.idle-lock')) {
                $response->header('X-Vibe-Idle-Lock-Url', route('password.idle-lock', [], false));
            } elseif (\Illuminate\Support\Facades\Route::has('password.confirm')) {
                $response->header('X-Vibe-Idle-Lock-Url', route('password.confirm', [], false) . '/idle-lock');
            }
            if (\Illuminate\Support\Facades\Route::has('auth.keep-alive')) {
                $response->header('X-Vibe-Keep-Alive-Url', route('auth.keep-alive', [], false));
            }
        }

        return $response;
    }
}
