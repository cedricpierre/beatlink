<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Inertia\Inertia;

return Application::configure(basePath: dirname(__DIR__))
                  ->withRouting(
                      web     : __DIR__ . '/../routes/web.php',
                      commands: __DIR__ . '/../routes/console.php',
                      health  : '/up',
                  )
                  ->withMiddleware(function (Middleware $middleware) {
                      $middleware->validateCsrfTokens(except: [
                                                                  'stripe/*',
                                                              ]);

                      $middleware->web(append: [
                                                   \App\Http\Middleware\HandleInertiaRequests::class,
                                                   \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
                                               ]);

                  })
                  ->withExceptions(function (Exceptions $exceptions) {
                      $exceptions->shouldRenderJsonWhen(function (Request $request, Throwable $e) {
                          return $request->expectsJson();
                      });
                  })->create();
