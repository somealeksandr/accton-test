<?php

namespace App\Providers;

use App\ApiClients\ApiClientService;
use App\ApiClients\Contracts\ApiClientContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ApiClientContract::class, ApiClientService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
