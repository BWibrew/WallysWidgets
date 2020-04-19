<?php

namespace App\Providers;

use App\Pack;
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
            return new PacksCalculatorService(Pack::pluck('size')->toArray());
        });
    }
}
