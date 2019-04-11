<?php

namespace App\Providers;

use App\Http\Helper\DingFacade\DingMethods;
use Illuminate\Support\ServiceProvider;

class DingServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('ding', function ($app) {
            return new DingMethods();
        });
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
