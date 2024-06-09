<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Services\SessionServices;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SessionServices::class, function ($app) {
            return new SessionServices();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ## Especifico a laravel que estoy usando bootstrap para que le de unos estilos adecuados a la paginacion 
        ## que crea con sus metodos
        Paginator::useBootstrapFive();
    }
}
