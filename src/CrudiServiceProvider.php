<?php

namespace Lordjoo\Crudi;

use Illuminate\Support\ServiceProvider;

class CrudiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        require_once  __DIR__.'/helpers.php';
        $this->publishes([
            __DIR__.'/public/' => public_path('vendor/crudi'),
        ], 'public');
        require __DIR__.'/routes/macro.php';

        $this->publishes([
            __DIR__.'/config/menus/' => app_path('menus'),
        ]);
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->loadViewsFrom(__DIR__.'/views', 'crudi');
    }
}
