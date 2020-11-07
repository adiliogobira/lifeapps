<?php

namespace Lifeapps\Integration;

use Illuminate\Support\ServiceProvider;

class LifeappsServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/lifeapps.php', 'lifeapps');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/lifeapps.php' => $this->app['path.config'] . DIRECTORY_SEPARATOR . 'lifeapps.php',
            ]);
        }
    }
}
