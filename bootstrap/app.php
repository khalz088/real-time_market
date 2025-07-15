<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'active' => \App\Http\Middleware\ActiveUserMiddleware::class,
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            'PDF' => Barryvdh\DomPDF\Facade\Pdf::class, // Add this line for DomPDF facade
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
