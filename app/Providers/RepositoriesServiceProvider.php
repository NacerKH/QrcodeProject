<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\ZipServiceInterface;
use App\Service\ZipService;
use App\Service\GenerateService;
use App\Contracts\GenerateServiceInterface;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $generateService =config('services.gener.default');
        $this->app->bind(GenerateServiceInterface::class, GenerateService::class);
        $this->app->bind(ZipServiceInterface::class, ZipService::class);
    }
}
