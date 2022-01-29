<?php

namespace Timedoor\Doku;

use Illuminate\Support\ServiceProvider;

class TimedoorDokuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make(DokuHandler::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/doku.php', 'doku');
    }
}
