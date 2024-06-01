<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

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
        /* @phpstan-ignore-next-line */
        if (env('FORCE_HTTPS', false) == 'true') {
            /* @phpstan-ignore-next-line */
            \URL::forceRootUrl(env('APP_URL'));
            \URL::forceScheme('https');
            $this->app['request']->server->set('HTTPS', 'on');
        }
        // Vite::useBuildDirectory('build/fe');
        Carbon::setLocale('id');
    }
}
