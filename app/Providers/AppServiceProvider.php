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
        Config::set('app.timezone', env('APP_TIMEZONE', 'UTC'));
        // Force MySQL/MariaDB session to Malaysia time (UTC+08:00)
        DB::statement("SET time_zone = '+08:00'");
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
