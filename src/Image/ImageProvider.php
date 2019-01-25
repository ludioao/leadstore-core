<?php

namespace AvoRed\Framework\Image;

use Illuminate\Support\ServiceProvider;

class ImageProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerImageService();

        $this->app->alias('image', 'AvoRed\Framework\Image\Manager');
    }

    /**
     * Register the Image Service instance.
     *
     * @return void
     */
    protected function registerImageService()
    {
        $this->app->singleton('image', function ($app) {
            return new Manager();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['image', 'AvoRed\Framework\Image\Manager'];
    }
}
