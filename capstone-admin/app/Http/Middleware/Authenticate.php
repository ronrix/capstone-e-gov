<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
    }

    /*
     * Guard the routes by redirecting the user if not authenticated
    */
    public function handle($request, Closure $next, ...$guards)
    {
        if (auth()->check()) {
            return $next($request);
        }

        return redirect("login");
        /* return response()->view('errors.check-permission'); */
    }
}
