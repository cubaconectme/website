<?php

namespace App\Providers;

use App\Http\Helper\DingFacade\DingMethods;
use App\Observers\RechargeObserver;
use App\Recharge;
use Illuminate\Auth\Events\Authenticated;
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
        $this->app['events']->listen(Authenticated::class, function ($e) {
            $user = $e->user->load('roles');
            view()->share('user', $user );
        });
    }
}
