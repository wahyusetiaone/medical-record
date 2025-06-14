<?php

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
        $middleware->api([
            \App\Http\Middlewares\VerifyJwtSecret::class, // Pastikan ini ada di sini!
        ]);
//        $middleware->alias([
//            'verify.jwt.secret' => \App\Http\Middlewares\VerifyJwtSecret::class
//        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
