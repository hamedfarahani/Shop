<?php

namespace App\Providers;

use App\Services\AttributeProductValueService;
use App\Services\AttributeProductValueServiceInterface;
use App\Services\Auth\LoginService;
use App\Services\Auth\LoginServiceInterface;
use App\Services\ProductService;
use App\Services\ProductServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServiceLayerProvider extends ServiceProvider
{

    public array $bindings = [
        LoginServiceInterface::class  => LoginService::class,
        ProductServiceInterface::class  => ProductService::class,
        AttributeProductValueServiceInterface::class  => AttributeProductValueService::class
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
