<?php

use App\Http\Middleware\RedirectIfAuthenticatedWithRole;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->priority([RoleMiddleware::class]);
        $middleware->priority([RedirectIfAuthenticatedWithRole::class]);
        
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
