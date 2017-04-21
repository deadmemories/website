<?php

namespace App\Providers;

use App\Eloquent\Anime;
use Bundle\Entity\Anime\AnimeRepository;
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
        $this->app->bind('AnimeEntity', function($app) {
            return new AnimeRepository(new Anime());
        });
    }
}
