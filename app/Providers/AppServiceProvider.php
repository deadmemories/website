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
use Bundle\Repository\User\UserRepository;
use Bundle\Repository\User\UserRepositoryInterface;
use Bundle\Token\TokenModel;
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
        $this->app->bind(
            'Bundle\Repository\User\UserRepositoryInterface',
            'Bundle\Repository\User\UserRepository'
        );

        // UserInfo
        $this->app->bind(
            'Bundle\Repository\UserInfo\UserInfoInterface',
            'Bundle\Repository\UserInfo\UserInfoRepository'
        );

        // Image
        $this->app->bind(
            'Bundle\Repository\Image\ImageRepositoryInterface',
            'Bundle\Repository\Image\ImageRepository'
        );

        // Anime
        $this->app->bind(
            'Bundle\Repository\Anime\AnimeRepositoryInterface',
            'Bundle\Repository\Anime\AnimeRepository'
        );

        // Token
        $this->app->bind(
            'Bundle\Token\Repository\TokenRepositoryInterface',
            'Bundle\Token\Repository\TokenRepository'
        );
    }
}
