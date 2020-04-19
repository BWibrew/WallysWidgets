<?php

namespace App\Providers;

use App\Services\PacksCalculatorService;
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('PacksCalculatorService', function () {
            return new PacksCalculatorService([250, 500, 1000, 2000, 5000]);
        });
    }
}
