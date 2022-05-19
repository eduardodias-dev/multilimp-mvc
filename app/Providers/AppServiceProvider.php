<?php

namespace App\Providers;

use App\Services\Implementations\ClienteService;
use App\Services\Implementations\OrdemServicoService;
use App\Services\Interfaces\IClienteService;
use App\Services\Interfaces\IOrdemServicoService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(IClienteService::class, ClienteService::class);
        $this->app->bind(IOrdemServicoService::class, OrdemServicoService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
