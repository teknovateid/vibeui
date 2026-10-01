<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureDemoUserIsLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::check() && app()->environment('local', 'testing')) {
            $user = User::firstOrCreate(
                ['email' => 'demo@vibeui.test'],
                [
                    'name' => 'Demo User',
                    'username' => 'demouser',
                    'phone' => '08123456789',
                    'password' => bcrypt('password'),
                    'email_verified_at' => now(),
                ]
            );
            Auth::login($user);
        }

        return $next($request);
    }
}
