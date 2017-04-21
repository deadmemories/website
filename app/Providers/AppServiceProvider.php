<?php

namespace App\Providers;

use Bundle\Entity\User\UserEntity;
use Bundle\MakeResponse\MakeArray;
use Bundle\Repository\Image\CloudImage;
use Bundle\Repository\Image\DatabaseImage;
use Bundle\Repository\User\UserRepository;
use Bundle\ResponseApi\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // User
        $this->app->bind('UserRepository', function($app) {
            return new UserRepository($app->make('UserEntity'));
        });

        // Image
        $this->app->bind('DImage', function($app) {
            return new DatabaseImage($app->make('ImageEntity'));
        });
        $this->app->bind('CImage', function($app) {
            return new CloudImage(new Storage());
        });

        // Response
        $this->app->bind('ResponseApi', function($app) {
            return new Response();
        });

        // MakeArray
        $this->app->bind('MakeArray', function($app) {
            return new MakeArray();
        });
        // Make Single
        $this->app->bind('MakeSingle', function($app) {
            return new MakeSingle();
        });
    }
}
