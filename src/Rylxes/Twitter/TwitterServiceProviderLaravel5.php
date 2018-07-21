<?php

namespace Rylxes\Twitter;

use Illuminate\Support\ServiceProvider;

class TwitterServiceProviderLaravel5 extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;
        $this->mergeConfigFrom(__DIR__.'/../../config/config.php', 'ttwitter');
        $this->publishes([
            __DIR__.'/../../config/config.php' => config_path('ttwitter.php'),
        ]);
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
