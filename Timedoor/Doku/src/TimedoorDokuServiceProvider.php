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
        //
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
