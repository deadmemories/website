<?php

namespace App\Providers;

use Bundle\Model\Image\DatabaseImage;
use Bundle\Model\User\UserModel;
use Bundle\Repository\Image\ImageRepository;
use Bundle\Repository\User\UserRepository;
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
        $this->app->bind(UserModel::class, function($app) {
            return new UserModel($app->make(UserRepository::class), $app->make(ResponseServiceProvider::class));
        });

        // Image
        $this->app->bind(DatabaseImage::class, function($app) {
            return new DatabaseImage($app->make(ImageRepository::class));
        });
        $this->app->bind('CImage', function($app) {
            return new CloudImage(new Storage());
        });

        // MakeArray
        $this->app->bind('MakeArray', function($app) {
            return new MakeArray();
        });
        // Make Single
        $this->app->bind('MakeSingle', function($app, $data) {
            return new MakeSingle($data);
        });

        // Anime
        $this->app->bind('AnimeRepository', function($app) {
            return new AnimeRepository($app->make('AnimeEntity'), $app->make('ResponseApi'));
        });
    }
}
