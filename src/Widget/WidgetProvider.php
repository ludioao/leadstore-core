<?php

namespace LeadStore\Framework\Widget;

use Illuminate\Support\ServiceProvider;
use LeadStore\Framework\User\Widget\TotalUserWidget;
use LeadStore\Framework\Order\Widget\TotalOrderWidget;
use LeadStore\Framework\Order\Widget\RecentOrderWidget;
use LeadStore\Framework\Product\Widget\MonthlyRevenueWidget;
use LeadStore\Framework\Widget\Facade as WidgetFacade;

class WidgetProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function boot()
    {
        $this->registerWidget();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerServices();
        $this->app->alias('widget', 'LeadStore\Framework\Widget\Manager');
    }

    /**
     * Register the Admin Menu instance.
     *
     * @return void
     */
    protected function registerServices()
    {
        $this->app->singleton('widget', function ($app) {
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
        return ['widget', 'LeadStore\Framework\Widget\Manager'];
    }

    /**
     * Register the Widget.
     *
     * @return void
     */
    protected function registerWidget()
    {
        $totalUserWidget = new TotalUserWidget();
        WidgetFacade::make($totalUserWidget->identifier(), $totalUserWidget);

        $monthlyRevenueWidget = new MonthlyRevenueWidget();
        WidgetFacade::make($monthlyRevenueWidget->identifier(), $monthlyRevenueWidget);

        $totalOrderWidget = new TotalOrderWidget();
        WidgetFacade::make($totalOrderWidget->identifier(), $totalOrderWidget);

        $recentOrderWidget = new RecentOrderWidget();
        WidgetFacade::make($recentOrderWidget->identifier(), $recentOrderWidget);
    }
}
