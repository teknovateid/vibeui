<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Middleware\ValidatePostSize as BaseValidatePostSize;

class ValidatePostSize extends BaseValidatePostSize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Bypass post size check for FilePond uploads in docs to allow testing large file uploads
        if ($request->is('docs/filepond/local-upload/*') || $request->is('docs/filepond/store')) {
            return $next($request);
        }

        return parent::handle($request, $next);
    }
}
