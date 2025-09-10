<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;

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
        // Keep your app timezone in config (safe everywhere)
        Config::set('app.timezone', env('APP_TIMEZONE', 'UTC'));

        // Only touch the DB when NOT running in console (composer/artisan/build)
        if (! app()->runningInConsole()) {
            try {
                // Only apply when using MySQL/MariaDB (skip sqlite, etc.)
                if (DB::getDriverName() === 'mysql') {
                    DB::statement("SET time_zone = '+08:00'");
                }
            } catch (\Throwable $e) {
                // Optional: log if you want, but don't crash the app during boot
                // \Log::warning('Failed to set session time_zone', ['error' => $e->getMessage()]);
            }
        }

        // Force HTTPS in production (this is fine to keep)
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
