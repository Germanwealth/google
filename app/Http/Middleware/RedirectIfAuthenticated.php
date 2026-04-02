<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            try {
                if (Auth::guard($guard)->check()) {
                    $user = Auth::guard($guard)->user();
                    $targetRoute = $user && $user->is_admin ? 'admin.dashboard' : 'home';

                    return redirect()->route($targetRoute);
                }
            } catch (\Exception $e) {
                // If session/auth check fails, allow the request through
                // This prevents infinite redirects from corrupted sessions
                continue;
            }
        }

        return $next($request);
    }
}
