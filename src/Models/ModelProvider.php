<?php

namespace LeadStore\Framework\Models;

use Illuminate\Support\ServiceProvider;
use LeadStore\Framework\Models\Contracts\ProductInterface;
use LeadStore\Framework\Models\Repository\ProductRepository;
use LeadStore\Framework\Models\Contracts\AttributeInterface;
use LeadStore\Framework\Models\Repository\AttributeRepository;
use LeadStore\Framework\Models\Contracts\CategoryInterface;
use LeadStore\Framework\Models\Repository\CategoryRepository;
use LeadStore\Framework\Models\Contracts\ConfigurationInterface;
use LeadStore\Framework\Models\Repository\ConfigurationRepository;
use LeadStore\Framework\Models\Contracts\OrderInterface;
use LeadStore\Framework\Models\Repository\OrderRepository;
use LeadStore\Framework\Models\Contracts\ProductDownloadableUrlInterface;
use LeadStore\Framework\Models\Repository\ProductDownloadableUrlRepository;
use LeadStore\Framework\Models\Repository\OrderHistoryRepository;
use LeadStore\Framework\Models\Contracts\OrderHistoryInterface;
use LeadStore\Framework\Models\Repository\PropertyRepository;
use LeadStore\Framework\Models\Contracts\PropertyInterface;
use LeadStore\Framework\Models\Repository\CategoryFilterRepository;
use LeadStore\Framework\Models\Contracts\CategoryFilterInterface;
use LeadStore\Framework\Models\Repository\AdminUserRepository;
use LeadStore\Framework\Models\Contracts\AdminUserInterface;
use LeadStore\Framework\Models\Contracts\MenuInterface;
use LeadStore\Framework\Models\Repository\MenuRepository;
use LeadStore\Framework\Models\Contracts\MenuGroupInterface;
use LeadStore\Framework\Models\Repository\MenuGroupRepository;
use LeadStore\Framework\Models\Contracts\PageInterface;
use LeadStore\Framework\Models\Repository\PageRepository;
use LeadStore\Framework\Models\Contracts\RoleInterface;
use LeadStore\Framework\Models\Repository\RoleRepository;
use LeadStore\Framework\Models\Contracts\SiteCurrencyInterface;
use LeadStore\Framework\Models\Repository\SiteCurrencyRepository;
use LeadStore\Framework\Models\Contracts\UserInterface;
use LeadStore\Framework\Models\Repository\UserRepository;
use LeadStore\Framework\Models\Contracts\UserGroupInterface;
use LeadStore\Framework\Models\Repository\UserGroupRepository;
use LeadStore\Framework\Models\Contracts\CountryInterface;
use LeadStore\Framework\Models\Repository\CountryRepository;
use LeadStore\Framework\Models\Contracts\StateInterface;
use LeadStore\Framework\Models\Repository\StateRepository;
use LeadStore\Framework\Models\Contracts\OrderStatusInterface;
use LeadStore\Framework\Models\Repository\OrderStatusRepository;
use LeadStore\Framework\Models\Contracts\OrderReturnRequestInterface;
use LeadStore\Framework\Models\Repository\OrderReturnRequestRepository;
use LeadStore\Framework\Models\Contracts\OrderReturnProductInterface;
use LeadStore\Framework\Models\Repository\OrderReturnProductRepository;

class ModelProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Models Array list to bind with It's Contact
     * @var array $models
     */
    protected $models = [
        AdminUserInterface::class => AdminUserRepository::class,
        AttributeInterface::class => AttributeRepository::class,
        CategoryInterface::class => CategoryRepository::class,
        CategoryFilterInterface::class => CategoryFilterRepository::class,
        ConfigurationInterface::class => ConfigurationRepository::class,
        CountryInterface::class => CountryRepository::class,
        MenuInterface::class => MenuRepository::class,
        MenuGroupInterface::class => MenuGroupRepository::class,
        OrderInterface::class => OrderRepository::class,
        OrderHistoryInterface::class => OrderHistoryRepository::class,
        OrderReturnProductInterface::class => OrderReturnProductRepository::class,
        OrderReturnRequestInterface::class => OrderReturnRequestRepository::class,
        OrderStatusInterface::class => OrderStatusRepository::class,
        PageInterface::class => PageRepository::class,
        ProductInterface::class => ProductRepository::class,
        ProductDownloadableUrlInterface::class => ProductDownloadableUrlRepository::class,
        PropertyInterface::class => PropertyRepository::class,
        RoleInterface::class => RoleRepository::class,
        SiteCurrencyInterface::class => SiteCurrencyRepository::class,
        StateInterface::class => StateRepository::class,
        UserInterface::class => UserRepository::class,
        UserGroupInterface::class => UserGroupRepository::class,
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerModelContracts();
    }

    /**
     * Bind The Eloquent Model with their contract.
     *
     * @return void
     */
    protected function registerModelContracts()
    {
        foreach ($this->models as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }
}
