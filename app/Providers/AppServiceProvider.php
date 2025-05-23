<?php

namespace App\Providers;

use Exception;
use App\Models\SettingEmail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
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
        // if (app()->environment('local')) {
        //     \Illuminate\Support\Facades\Vite::useHotFile(public_path('build/.vite-hot'));
        // }
    }
}
