<?php

namespace App\Providers;

use App\Services\Auth\LoginService;
use App\Services\Auth\LoginServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServiceLayerProvider extends ServiceProvider
{

    public array $bindings = [
        LoginServiceInterface::class  => LoginService::class
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
