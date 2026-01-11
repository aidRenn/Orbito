<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Paksa HTTPS di production (Railway)
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        // Share navigation globally to all views
        view()->share('navigation', config('navigation'));
    }
}
