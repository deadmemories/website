<?php

namespace App\Providers;

use App\Eloquent\Anime;
use Bundle\Repository\Anime\AnimeRepository;
use Illuminate\Support\ServiceProvider;

class AnimeServiceProvider extends ServiceProvider
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
        $this->app->bind('AnimeRepository', function($app) {
            return new AnimeRepository(new Anime());
        });
    }
}
