<?php

namespace App\Providers;

use Bundle\Token\Eloquent\Token;
use Bundle\Token\Repository\TokenRepository;
use Illuminate\Support\ServiceProvider;

class TokenServiceProvider extends ServiceProvider
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
        $this->app->bind('TokenRepository', function($app) {
            return new TokenRepository(new Token());
        });
    }
}
