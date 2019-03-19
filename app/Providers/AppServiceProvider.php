<?php

namespace App\Providers;

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
        //
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
