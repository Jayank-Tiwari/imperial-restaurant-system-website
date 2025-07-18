<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request and allow access only to users with the correct role
     * based on the dashboard route they are trying to access.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role;
        $route = $request->route()->getName(); // e.g., admin.dashboard

        $roleRouteMap = [
            'admin'    => 'admin.dashboard',
            'user'     => 'user.dashboard',
            'delivery' => 'delivery.dashboard',
        ];

        // Check if route name starts with the correct role
        foreach ($roleRouteMap as $role => $dashboardRoute) {
            if (str_starts_with($route, $role)) {
                if ($userRole !== $role) {
                    return redirect()->route('login');
                }
            }
        }

        return $next($request);
    }
}
