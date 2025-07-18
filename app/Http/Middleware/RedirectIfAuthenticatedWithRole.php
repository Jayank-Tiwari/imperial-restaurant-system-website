<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class RedirectIfAuthenticatedWithRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $role = Auth::user()->role;

            return match ($role) {
                'admin'    => redirect()->route('admin.dashboard'),
                'delivery' => redirect()->route('delivery.dashboard'),
                default    => redirect()->route('user.dashboard'),
            };
        }

        return $next($request);
    }
}
