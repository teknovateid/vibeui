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

            $lastActivity = $request->session()->get('auth.last_activity_time');
            $now = time();

            // Jika durasi inaktivitas telah mencapai atau melebihi batas waktu
            if ($lastActivity && ($now - (int) $lastActivity) >= $timeout) {
                // Kunci sesi pengguna
                $request->session()->put('auth.session_locked', true);
                $request->session()->forget('auth.password_confirmed_at');
                $request->session()->forget('auth.confirmed_route');
                $request->session()->put('auth.last_activity_time', $now);

                // Simpan URL yang sedang dituju pengguna
                $request->session()->put('url.intended', $request->fullUrl());

                if ($request->expectsJson() && ! $request->hasHeader('X-Livewire-Navigate')) {
                    return response()->json([
                        'message' => 'Session locked due to inactivity.',
                    ], 423);
                }

                $redirect = redirect('/confirm-password')->with('status', 'idle_timeout');

                if ($request->hasHeader('X-Livewire-Navigate')) {
                    $redirect->header('X-Livewire-Redirect', '/confirm-password');
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
            $response->header('X-Vibe-Idle-Timeout', (string) $timeout);
        }

        return $response;
    }
}
