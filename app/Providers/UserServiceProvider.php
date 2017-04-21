<?php

namespace App\Providers;

use App\Eloquent\User;
use Bundle\Entity\User\UserEntity;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('UserEntity', function($app) {
            return new UserEntity(new User());
        });
    }
}
