<?php

namespace Rylxes\Twitter;

use Illuminate\Support\ServiceProvider;

class TwitterServiceProviderLumen extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'ttwitter');
        $this->publishes([
            __DIR__ . '/../config/config.php' => base_path('config/ttwitter.php'),
        ]);
        // set configuration
        $this->app->singleton(Twitter::class, function () use ($app) {
            return new Twitter($app['config'], $app['session.store']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['ttwitter'];
    }
}
