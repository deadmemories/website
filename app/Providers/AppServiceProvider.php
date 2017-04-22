<?php

namespace App\Providers;

use Bundle\MakeResponse\MakeArray;
use Bundle\MakeResponse\MakeSingle;
use Bundle\Model\Anime\AnimeModel;
use Bundle\Model\Image\CloudImage;
use Bundle\Model\Image\DatabaseImage;
use Bundle\Model\User\AuthModel;
use Bundle\Model\User\UserModel;
use Bundle\Model\UserInfo\UserInfoModel;
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
        $this->app->bind('UserModel', function($app) {
            return new UserModel($app->make('UserRepository'), $app->make('ResponseServiceProvider'));
        });

        // UserInfo
        $this->app->bind('UserInfoModel', function($app) {
            return new UserInfoModel($app->make('UserInfoRepository'), $app->make('ResponseApi'));
        });

        // Image
        $this->app->bind('DImage', function($app) {
            return new DatabaseImage($app->make('ImageRepository'));
        });
        $this->app->bind('CImage', function($app) {
            return new CloudImage(new Storage());
        });

        // Make Single
        $this->app->bind('MakeSingle', function($app, $data) {
            return new MakeSingle($data);
        });

        // Anime
        $this->app->bind('AnimeModel', function($app) {
            return new AnimeModel($app->make('AnimeRepository'), $app->make('ResponseApi'));
        });

        // AuthModel
        $this->app->bind(AuthModel::class);
    }
}
