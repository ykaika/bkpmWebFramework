<?php

use App\Http\Middleware\CheckProfileRoute;
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
        $middleware->alias([
            'check.profile' => CheckProfileRoute::class, // link dokumentasi https://laravel.com/docs/11.x/routing#parameters-global-constraints
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();