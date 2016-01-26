<?php

namespace Banijya\Providers;

use Illuminate\Support\ServiceProvider;
use Banijya\User;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
          User::created(function ($user) {
            $user->aavatar()->create([]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
