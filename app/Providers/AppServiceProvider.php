<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('create-poll', function (Request $request) {
            return Limit::perHour(5)->by($request->ip());
        });

        RateLimiter::for('vote-poll', function (Request $request) {
            return Limit::perMinute(30)->by($request->ip());
        });

        RateLimiter::for('create-havenella-post', function (Request $request) {
            return Limit::perHour(3)->by($request->ip());
        });

        RateLimiter::for('vote-havenella-post', function (Request $request) {
            return Limit::perMinute(60)->by($request->ip());
        });
    }
}
