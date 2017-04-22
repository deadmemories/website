<?php

namespace App\Providers;

use App\Eloquent\UserInfo;
use Bundle\Repository\User\UserRepository;
use Bundle\Repository\UserInfo\UserInfoRepository;
use Illuminate\Support\ServiceProvider;

class UserInfoServiceProvider extends ServiceProvider
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
        $this->app->bind('UserInfoRepository', function($app) {
            return new UserInfoRepository(new UserInfo());
        });
    }
}
