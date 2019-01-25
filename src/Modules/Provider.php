<?php

namespace LeadStore\Framework\Modules;

use Illuminate\Support\ServiceProvider;
use LeadStore\Framework\Modules\Facade as Module;

class Provider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function boot()
    {
        $modules = Module::all();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerModuleConsoleProvider();
        $this->registerModule();
        $this->app->alias('module', 'LeadStore\Framework\Modules\Manager');
    }

    /**
     * Register the AdmainConfiguration instance.
     *
     * @return void
     */
    protected function registerModule()
    {
        $this->app->singleton('module', function ($app) {
            return new Manager($app['files']);
        });
    }

    /*
     * Register Module console Command which Register most Module generation Command
     *
     * @return void
     */
    public function registerModuleConsoleProvider()
    {
        $this->app->register('LeadStore\Framework\Modules\Console\Provider');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['module', 'LeadStore\Framework\Modules\Manager'];
    }
}
