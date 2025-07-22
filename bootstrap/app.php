<?php

use App\Http\Middleware\RedirectIfAuthenticatedWithRole;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // Add middleware alias for convenience in your routes
        $middleware->alias([
            'role' => RoleMiddleware::class,
        ]);

        // This correctly ADDS your SetLocale middleware to the 'web' group
        // without removing the existing ones.
        $middleware->appendToGroup('web', SetLocale::class);

        // Your priority middleware must be in a single array.
        // This ensures the correct order is loaded.
        $middleware->priority([
            RoleMiddleware::class,
            RedirectIfAuthenticatedWithRole::class,
        ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
