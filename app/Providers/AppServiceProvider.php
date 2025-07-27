<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        Blade::component('admin.components.sidebar', 'sidebar');
        Blade::component('admin.components.sidebar-link', 'sidebar-link');
        Blade::component('admin.components.layout', 'layout-admin');
        Blade::component('admin.components.header', 'header-admin');
    }
}
