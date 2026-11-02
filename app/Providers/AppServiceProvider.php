<?php

namespace App\Providers;

use App\Services\StudentReader;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use App\Services\DatabaseStudentReader;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            StudentReader::class,
            DatabaseStudentReader::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Custom API rate limiter
        RateLimiter::for('api-custom', function (Request $request) {
            return Limit::perMinute(3)
                ->by($request->user()?->id ?: $request->ip());
        });
    }
}
