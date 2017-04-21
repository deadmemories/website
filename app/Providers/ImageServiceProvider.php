<?php

namespace App\Providers;

use App\Eloquent\Image;
use Bundle\Entity\Image\ImageEntity;
use Illuminate\Support\ServiceProvider;

class ImageServiceProvider extends ServiceProvider
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
        $this->app->bind('ImageEntity', function($app) {
            return new ImageEntity(new Image());
        });
    }
}
