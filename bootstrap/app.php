
<?php

use App\Http\Middleware\NameNum;
use App\Http\Middleware\RoleMiddleware;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException ;

use Laravel\Sanctum\Http\Middleware\CheckAbilities;
use Laravel\Sanctum\Http\Middleware\CheckForAnyAbility;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware): void {

        $middleware->alias([
            // Custom middleware
            // 'name' => NameNum::class,
            'role' => RoleMiddleware::class,

            // Sanctum middleware
            'abilities' => CheckAbilities::class,
            'ability' => CheckForAnyAbility::class,
        ]);

        // API requests should not redirect guests to a web login page
        $middleware->redirectGuestsTo(
            fn (Request $request) =>
                $request->is('api/*') ? null : '/login'
        );
    })

    ->withExceptions(function (Exceptions $exceptions): void {

        // Render API exceptions as JSON
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) =>
                $request->is('api/*') || $request->expectsJson(),
        );

        // Handle unauthenticated API requests
        $exceptions->render(function (
           AuthenticationException  $e,
            Request $request
        ) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Unauthenticated.',
                    'status' => 401,
                ], 401);
            }

            return null;
        });

        // Handle missing Eloquent models
        $exceptions->render(function (
           AuthenticationException  $e,
            Request $request
        ) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'The requested resource was not found.',
                    'status' => 404,
                ], 404);
            }

            return null;
        });
    })

    ->create();

