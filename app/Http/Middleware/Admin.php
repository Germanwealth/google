<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::guard('web')->check()) {
            return redirect()->route('admin.login');
        }

        if (! Auth::guard('web')->user()?->is_admin) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
